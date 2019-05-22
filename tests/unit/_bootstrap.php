<?php

loadEnvironmentFromFile(codecept_root_dir('.env.testing'));
require codecept_root_dir('bootstrap/app.php');

unset(container()['RecipientRepository']);
container()['RecipientRepository'] = function ($container) {
    return new \App\Repositories\Collection\RecipientRepository();
};

unset(container()['OfferRepository']);
container()['OfferRepository'] = function ($container) {
    return new \App\Repositories\Collection\OfferRepository();
};

unset(container()['VoucherRepository']);
container()['VoucherRepository'] = function ($container) {
    return new \App\Repositories\Collection\VoucherRepository();
};
