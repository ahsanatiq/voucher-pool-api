<?php
namespace App\Exceptions;

class InvalidVoucherCodeException extends BaseException
{
    public function __construct()
    {
        parent::__construct("Invalid code.", 422);
    }
}
