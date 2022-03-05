<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;

class ApiKeyAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bearerToken = $request->bearerToken();
        $apiKey = ApiKey::where('key', $bearerToken)->where('active', true)->first();
        if (!$apiKey) {
            abort(403, 'Invalid API Key');
        }
        return $next($request);
    }
}
