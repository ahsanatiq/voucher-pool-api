<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\OfferRepositoryInterface;

class OfferRepository implements OfferRepositoryInterface
{
    private $OfferModel;

    public function __construct($container)
    {
        $this->OfferModel = $container->get('OfferModel');
    }

    public function getAll()
    {
        return $this->OfferModel->orderBy('id', 'desc')->get();
    }

    public function create($data)
    {
        return $this->OfferModel->create($data);
    }
}
