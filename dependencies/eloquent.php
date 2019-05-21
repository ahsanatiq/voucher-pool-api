<?php

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db'][$container['settings']['db']['default']]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

return $capsule;
