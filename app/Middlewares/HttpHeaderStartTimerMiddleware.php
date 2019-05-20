<?php
namespace App\Middlewares;

class HttpHeaderStartTimerMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $_SESSION['startTime'] = microtime(true);
        $response = $next($request, $response);
        return $response;
    }
}
