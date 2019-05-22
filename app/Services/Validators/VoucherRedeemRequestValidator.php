<?php
namespace App\Services\Validators;

use Slim\Container;

class VoucherRedeemRequestValidator extends BaseValidator
{
    public $rules = [
        'email' => ['required', 'email'],
        'code'  => ['required'],
    ];

    public $filters = [
        'email' => ['trim', 'strLower'],
        'code'  => ['trim'],
    ];

    public function __construct(Container $container)
    {
        $this->rules['code'][] = 'max:'. config('hashids.code_length');
        parent::__construct($container);
    }
}
