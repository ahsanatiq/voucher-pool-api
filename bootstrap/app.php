<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

if (isset($_SERVER['HTTP_APP_ENV']) && !empty($_SERVER['HTTP_APP_ENV'])) {
    $envFile = __DIR__ . '/../.env.' . $_SERVER['HTTP_APP_ENV'];
} else {
    $commandArgs = parseCliArguments();
    if (isset($commandArgs['env']) && !empty($commandArgs['env'])) {
        $envFile = __DIR__ . '/../.env.' . $commandArgs['env'];
    }
}
$envFile = $envFile ?? __DIR__.'/../.env';
if(file_exists($envFile)) {
    loadEnvironmentFromFile($envFile);
}

// Instantiate the app
$settings = require __DIR__ . '/../config/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../app/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../routes/routes.php';
$routes($app);
