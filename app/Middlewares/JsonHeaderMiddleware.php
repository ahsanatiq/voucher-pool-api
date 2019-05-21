<?php
namespace App\Middlewares;

class JsonHeaderMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $request = $request->withHeader('accept', 'application/json');
        $response = $next($request, $response);
        return $response;
    }
}
