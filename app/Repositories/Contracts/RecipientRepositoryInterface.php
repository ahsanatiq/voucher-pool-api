<?php
namespace App\Repositories\Contracts;

interface RecipientRepositoryInterface
{
    public function getAll();
    public function getByEmail($email);
}
