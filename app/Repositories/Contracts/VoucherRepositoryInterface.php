<?php
namespace App\Repositories\Contracts;

interface VoucherRepositoryInterface
{
    public function getAll();
    public function getByRecipient($data);
    public function create($data);
}
