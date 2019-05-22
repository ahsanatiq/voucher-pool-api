<?php
namespace App\Repositories\Eloquent;

use Carbon\Carbon;
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
        return $this->OfferModel->orderBy('id', 'desc')->get()->toArray();
    }

    public function getAllActive()
    {
        return $this->OfferModel->where('expire_at', '>=', Carbon::tomorrow())->get()->toArray();
    }

    public function getById($id)
    {
        $result = $this->OfferModel->where('id', $id)->first();
        return $result ? $result->toArray() : array();
    }

    public function create($data)
    {
        return $this->OfferModel->create($data);
    }
}
