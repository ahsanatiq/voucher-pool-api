<?php
namespace App\Repositories\Contracts;

interface OfferRepositoryInterface
{
    public function getAll();
    public function getAllActive();
    public function create($data);
}
