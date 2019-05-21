<?php
namespace App\Services;

use Slim\Container;

class OfferService extends BaseService
{
    private $offerRepository;
    private $offerValidator;
    private $RecipientService;
    private $VoucherService;

    public function __construct(Container $container)
    {
        $this->offerRepository = $container->get('OfferRepository');
        $this->offerValidator = $container->get('OfferValidator');
        $this->RecipientService = $container->get('RecipientService');
        $this->VoucherService = $container->get('VoucherService');
    }

    public function getAll()
    {
        return $this->offerRepository->getAll();
    }

    public function create($data)
    {
        $data = $this->offerValidator->sanitize($data);
        $this->offerValidator->validate($data);
        $offer = $this->offerRepository->create($data);

        $recipients = $this->RecipientService->getAll();
        $vouchers = $this->VoucherService->create($recipients, $offer);

        return $offer;
    }
}
