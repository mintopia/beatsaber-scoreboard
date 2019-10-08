<?php

namespace App\Http\Middleware;

use App\ApiLog;
use Closure;
use Illuminate\Http\Request;

class ApiLoggerMiddleware
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
        $request->attributes->set('startTime', microtime(true));
        return $next($request);
    }

    public function terminate(Request $request, $response)
    {
        $log = ApiLog::createFromMiddleware($request, $response);
        $startTime = $request->attributes->get('startTime');
        $log->duration = 0;
        if ($startTime) {
            $log->duration = round((microtime(true) - $startTime) * 1000, 0);
        }
        $log->save();
    }
}
