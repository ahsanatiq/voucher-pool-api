<?php

use App\Exceptions\NotFoundHttpException;

return function ($request, $response) use ($container) {
    return \App\Exceptions\ExceptionHandler::handle(new NotFoundHttpException, $request, $response);
};
