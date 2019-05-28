<?php
$_SERVER['HTTP_APP_ENV'] = 'testing';
require codecept_root_dir('bootstrap/app.php');

unset(container()['RecipientRepository']);
container()['RecipientRepository'] = function ($container) {
    return new \App\Repositories\Collection\RecipientRepository($container);
};

unset(container()['OfferRepository']);
container()['OfferRepository'] = function ($container) {
    return new \App\Repositories\Collection\OfferRepository($container);
};

unset(container()['VoucherRepository']);
container()['VoucherRepository'] = function ($container) {
    return new \App\Repositories\Collection\VoucherRepository($container);
};
