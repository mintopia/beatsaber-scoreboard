<?php

namespace App\Http\Middleware;

use App\ApiKey;
use Closure;

class ApiKeyAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bearerToken = $request->bearerToken();
        $apiKey = ApiKey::where('key', $bearerToken)->where('active', true)->first();
        if (!$apiKey) {
            abort(403, 'Invalid API Key');
        }
        return $next($request);
    }
}
