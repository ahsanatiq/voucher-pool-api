<?php

$settings = $container->get('settings');
$logger = new \Monolog\Logger($settings['name']);
$logger->pushProcessor(new \Monolog\Processor\UidProcessor());
$logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], $settings['logger']['level']));
return $logger;
