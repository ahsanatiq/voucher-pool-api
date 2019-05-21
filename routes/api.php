<?php

$app->group('/api/v1', function ($app) {
    // Recipients
    $app->get('/recipients', 'RecipientController:getList');
    $app->get('/recipients/vouchers', 'RecipientController:getVouchers');
    // Offers
    // $app->get('/offers', OffersController::class . ':index');
    // $app->post('/offers', OffersController::class . ':create');
    // Voucher
    // $app->post('/validate_voucher', VouchersController::class . ':validate');
});
