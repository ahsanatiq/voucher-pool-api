<?php

 return [
    'path'  => getenv('APP_LOG_FILE') ?: '/var/www/logs/app.log',
    'days'  => getenv('APP_LOG_DAYS') ?: '7',
    'level' => getenv('APP_LOG_LEVEL') ?: \Monolog\Logger::DEBUG,
 ];
