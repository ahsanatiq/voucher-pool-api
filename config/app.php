<?php

return [
    'env'                    => getenv('APP_ENV')  ?: 'dev', // dev, testing, production
    'name'                   => getenv('APP_NAME') ?: 'voucher-pool-api',
    'url'                    => getenv('APP_URL')  ?: 'http://localhost:8080',
    'displayErrorDetails'    => true,
    'addContentLengthHeader' => false
];
