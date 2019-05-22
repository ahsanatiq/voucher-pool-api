<?php
namespace App\Services\Validators;

class OfferValidator extends BaseValidator
{
    public $rules = [
        'name'      => ['required', 'max:100'],
        'discount'  => ['required', 'numeric', 'between:0,100'],
        'expire_at' => ['required', 'date', 'after:today'],
    ];

    public $filters = [
        'name'      => ['trim'],
        'discount'  => ['trim', 'decimalFormat'],
        'expire_at' => ['trim', 'dateFormat'],
    ];
}
