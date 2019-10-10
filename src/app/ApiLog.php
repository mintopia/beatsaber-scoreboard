<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * App\ApiLog
 *
 * @property int $id
 * @property string $uri
 * @property string $method
 * @property string $ip
 * @property object|null $request_headers
 * @property object|null $request_body
 * @property int $response_code
 * @property object|null $response_headers
 * @property object|null $response_body
 * @property int $duration
 * @property int|null $apikey_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\ApiKey|null $apikey
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereApikeyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereRequestBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereRequestHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereResponseBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereResponseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereResponseHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiLog whereUri($value)
 * @mixin \Eloquent
 */
class ApiLog extends Model
{
    protected $casts = [
        'request_headers' => 'object',
        'request_body' => 'object',
        'response_headers' => 'object',
        'response_body' => 'object'
    ];

    public function apikey()
    {
        return $this->belongsTo(ApiKey::class);
    }

    public static function createFromMiddleware($request, $response)
    {
        $log = new ApiLog;
        $bearerToken = $request->bearerToken();
        $apikey = ApiKey::where('key', $bearerToken)->first();
        if ($apikey) {
            $log->apikey()->associate($apikey);
        }

        $log->uri = $request->getRequestUri();
        $log->method = $request->getMethod();
        $log->ip = $request->ip();
        $log->request_headers = (object) $request->headers->all();
        $log->request_body = $request->getContent();

        $log->response_code = $response->getStatusCode();
        $log->response_headers = $response->headers->allPreserveCase();
        $log->response_body = $response->getContent();

        return $log;
    }
}
