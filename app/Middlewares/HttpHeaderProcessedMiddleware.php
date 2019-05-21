<?php
namespace App\Middlewares;

class HttpHeaderProcessedMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);
        $endTime = microtime(true);
        $time = number_format(($endTime - $request->getAttribute('startTime')), 3);
        return $response->withHeader('X-Processed-Time', $time);
    }
}
