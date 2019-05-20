<?php
$envTesting = require 'parse_env.php';
$parse_env = 'default';
$envDefault = require 'parse_env.php';

return [
    'paths' => [
        'migrations' => ['database' => __DIR__.'/database/migrations'],
        'seeds'      => ['database' => __DIR__.'/database/seeds'],
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'default',
        'default' => [
            'adapter' => $envDefault['DB_CONNECTION']??'',
            'host'    => $envDefault['DB_HOST']??'',
            'name'    => $envDefault['DB_NAME']??'',
            'user'    => $envDefault['DB_USER']??'',
            'pass'    => $envDefault['DB_PASSWORD']??'',
            'port'    => $envDefault['DB_PORT']??'',
        ],
        'testing' => [
            'adapter' => $envTesting['DB_CONNECTION']??'',
            'host'    => $envTesting['DB_HOST']??'',
            'name'    => $envTesting['DB_NAME']??'',
            'user'    => $envTesting['DB_USER']??'',
            'pass'    => $envTesting['DB_PASSWORD']??'',
            'port'    => $envTesting['DB_PORT']??'',
        ]
    ]
];
