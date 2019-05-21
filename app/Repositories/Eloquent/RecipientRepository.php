<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RecipientRepositoryInterface;

class RecipientRepository implements RecipientRepositoryInterface
{
    private $recipientModel;

    public function __construct($container)
    {
        $this->recipientModel = $container->get('RecipientModel');
    }

    public function getAll()
    {
        return $this->recipientModel->orderBy('id', 'desc')->get();
    }
}
