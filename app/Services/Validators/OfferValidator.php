<?php
namespace App\Services\Validators;

class OfferValidator extends BaseValidator
{
    public $rules = [
        'name'            => ['required', 'max:250'],
        'discount'        => ['required', 'numeric', 'between:0,100'],
        'expiration_date' => ['required', 'date', 'after:today'],
    ];

    public $filters = [
      'name'            => ['trim'],
      'discount'        => ['trim', 'decimalFormat'],
      'expiration_date' => ['trim', 'dateFormat'],
    ];
}
