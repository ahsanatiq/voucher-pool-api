<?php
namespace App\Exceptions;

class UsedVoucherCodeException extends BaseException
{
    public function __construct()
    {
        parent::__construct("Offer is already used.", 422);
    }
}
