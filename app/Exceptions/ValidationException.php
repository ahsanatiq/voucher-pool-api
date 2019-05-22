<?php

namespace App\Exceptions;

use Illuminate\Support\MessageBag;

class ValidationException extends BaseException
{
    public function __construct($errors = null)
    {
        $this->setErrors($errors);
        parent::__construct($this->errors->first(), 422);
    }

    protected function setErrors($errors)
    {
        if (is_string($errors)) {
            $errors = [
                'error' => $errors,
            ];
        }
        if (is_array($errors)) {
            $this->errors = new MessageBag($errors);
        } else {
            $this->errors = $errors;
        }
    }

    public function getErrors()
    {
        $errors = $this->errors;
        if ($errors->any()) {
            return $errors->all();
        }
        return [];
    }

    public function getExceptionMessage()
    {
        return  $this->getErrors();
    }
}
