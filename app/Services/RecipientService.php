<?php
namespace App\Services;

use Slim\Container;

class RecipientService extends BaseService
{
    private $recipientRepository;
    private $OfferService;
    private $VoucherService;
    private $hashids;

    public function __construct(Container $container)
    {
        $this->recipientRepository = $container->get('RecipientRepository');
        $this->OfferService = $container->get('OfferService');
        $this->VoucherService = $container->get('VoucherService');
        $this->hashids = $container->get('hashids');
    }

    public function getAll()
    {
        return $this->recipientRepository->getAll();
    }

    public function getByEmail($email)
    {
        return $this->recipientRepository->getByEmail($email);
    }

    public function getVouchers($recipientEmail)
    {
        $recipient = $this->getByEmail($recipientEmail);
        $offers = $this->OfferService->getAllActive();
        $usedOffersId = $this->VoucherService->getAllUsedOffers($recipient['id']);
        $offers = array_filter($offers, function($offer) use ($usedOffersId) {
            return !in_array($offer['id'], $usedOffersId);
        });
        return array_map(function($offer) use ($recipient) {
            return ['offer'=>$offer['name'], 'code' => $this->hashids->encode([$recipient['id'], $offer['id']])];
        }, $offers);
    }
}
