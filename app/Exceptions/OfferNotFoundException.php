<?php
namespace App\Exceptions;

class OfferNotFoundException extends BaseException
{
    public function __construct()
    {
        parent::__construct("Offer not found.", 404);
    }
}
