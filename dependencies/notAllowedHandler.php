<?php

use App\Exceptions\MethodNotAllowedHttpException;

return function ($request, $response) use ($container) {
    return \App\Exceptions\ExceptionHandler::handle(new MethodNotAllowedHttpException, $request, $response);
};
