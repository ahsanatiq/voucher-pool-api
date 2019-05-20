<?php

$capsule = new \Illuminate\Database\Capsule\Manager;
// $container->get('logger')->info('db connected:'. $container['settings']['db'][$container['settings']['db']['default']]);
$capsule->addConnection($container['settings']['db'][$container['settings']['db']['default']]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

return $capsule;
