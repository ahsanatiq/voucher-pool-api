<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->get('logger')->info("Slim-Skeleton '/' route");

    // return response in json
    return $response->withJson(['Hello'=>'world']);
});
