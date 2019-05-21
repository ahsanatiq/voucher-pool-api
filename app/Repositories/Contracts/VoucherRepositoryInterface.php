<?php
namespace App\Repositories\Contracts;

interface VoucherRepositoryInterface
{
    public function getAll();
    public function create($data);
}
