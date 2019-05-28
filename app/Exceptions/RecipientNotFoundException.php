<?php
namespace App\Exceptions;

class RecipientNotFoundException extends BaseException
{
    public function __construct()
    {
        parent::__construct("Recipient not found.", 404);
    }
}
