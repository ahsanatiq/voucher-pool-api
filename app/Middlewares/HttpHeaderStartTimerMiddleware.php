<?php
namespace App\Middlewares;

class HttpHeaderStartTimerMiddleware
{
    public function __invoke($request, $response, $next)
    {

        $request = $request->withAttribute('startTime', microtime(true));
        $response = $next($request, $response);
        return $response;
    }
}
