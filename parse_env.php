<?php
require_once 'vendor/autoload.php';
$parse_env = $parse_env ?? 'testing';
$environment = ($parse_env != 'default') ? '.'.$parse_env : '';
return parseEnvFile(__DIR__.'/.env' . $environment);
