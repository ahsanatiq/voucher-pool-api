<?php

$app->group('/api/v1', function ($app) {
    // Recipients
    $app->get('/recipients', 'RecipientController:getList');
    $app->get('/recipients/vouchers', 'RecipientController:getVouchers');
    // Offers
    $app->post('/offers', 'OfferController:create');
    // Voucher
    $app->post('/redeem', 'VoucherController:redeem');
});
