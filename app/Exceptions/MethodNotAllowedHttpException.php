<?php
namespace App\Exceptions;

class MethodNotAllowedHttpException extends BaseException
{
    public function __construct()
    {
        $message = "Method not allowed.";
        parent::__construct($message, 405);
    }
}
