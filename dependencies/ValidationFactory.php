<?php

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidationFactory;

$loader = new FileLoader(new Filesystem, __DIR__.'/../resources/lang');
$translator = new Translator($loader, 'en');
$validation = new ValidationFactory($translator, new Container);
return $validation;
