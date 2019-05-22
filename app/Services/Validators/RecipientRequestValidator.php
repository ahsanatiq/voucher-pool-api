<?php
namespace App\Services\Validators;

class RecipientRequestValidator extends BaseValidator
{
    public $rules = [
        'email'     => ['required', 'email'],
    ];

    public $filters = [
        'email'      => ['trim', 'strLower'],
    ];
}
