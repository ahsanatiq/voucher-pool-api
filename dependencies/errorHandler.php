<?php

return function ($request, $response, $exception) use ($container) {
    return \App\Exceptions\ExceptionHandler::handle($exception, $request, $response);
};
