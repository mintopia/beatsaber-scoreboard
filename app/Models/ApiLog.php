<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory;

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
