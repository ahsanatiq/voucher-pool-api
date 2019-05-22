<?php
namespace App\Services;

use Slim\Container;

class OfferService extends BaseService
{
    private $offerRepository;
    private $offerValidator;

    public function __construct(Container $container)
    {
        $this->offerRepository = $container->get('OfferRepository');
        $this->offerValidator = $container->get('OfferValidator');
    }

    public function getAll()
    {
        return $this->offerRepository->getAll();
    }

    public function getAllActive()
    {
        return $this->offerRepository->getAllActive();
    }

    public function getById($id)
    {
        return $this->offerRepository->getById($id);
    }

    public function create($data)
    {
        $data = $this->offerValidator->sanitize($data);
        $this->offerValidator->validate($data);
        $offer = $this->offerRepository->create($data);

        return $offer;
    }
}
