<?php

namespace App\Exceptions;

use App\Exceptions\UnexpectedException;
use App\Exceptions\ValidationException;
use App\Exceptions\NotFoundHttpException;
use App\Exceptions\RecipeNotFoundException;
use App\Exceptions\MethodNotAllowedHttpException;

class ExceptionHandler
{

    public static function handle($e, $request, $response)
    {
        $loggerLevel = 'debug';
        switch ($e) {
            case $e instanceof NotFoundHttpException:
                $data = $e->getData();
                break;
            case $e instanceof MethodNotAllowedHttpException:
                $data = $e->getData();
                break;
            case $e instanceof ValidationException:
                $data = $e->getData();
                break;
            case $e instanceof RecipeNotFoundException:
                $data = $e->getData();
                break;
            case $e instanceof UnauthorizedException:
                $data = $e->getData();
                $loggerLevel = 'info';
                break;
            default:
                $data = (new UnexpectedException)->getData();
                $loggerLevel = 'error';
                break;
        }

        $extraInfo = [
            'exception_type' => get_class($e),
            'exception_message' => $e->getMessage(),
            'trace' => $e->getTrace()
        ];

        container('logger')->$loggerLevel('Exception occured.', array_merge($data, $extraInfo));

        if (config()->get('app.env') != 'production') {
            $data = array_merge($data, $extraInfo);
        }

        return $response->withJson($data, $data['code']);
    }
}
