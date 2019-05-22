<?php
namespace App\Exceptions;

class NotFoundHttpException extends BaseException
{
    public function __construct()
    {
        $message = "Resource not found.";
        parent::__construct($message, 404);
    }
}
