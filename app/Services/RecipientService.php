<?php
namespace App\Services;

use Slim\Container;
use App\Exceptions\RecipientNotFoundException;

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
        $recipient = $this->recipientRepository->getByEmail($email);
        if ($recipient) {
            return $recipient;
        }
        throw new RecipientNotFoundException;
    }

    public function getVouchers($recipientEmail)
    {
        $recipient = $this->getByEmail($recipientEmail);
        $offers = $this->OfferService->getAllActive();
        $usedOffersId = $this->VoucherService->getAllUsedOffers($recipient['id']);

        if ($usedOffersId) {
            $offers = $offers->filter(function ($offer) use ($usedOffersId) {
                return !$usedOffersId->contains($offer['id']);
            });
        }
        return $offers->map(function ($offer) use ($recipient) {
            return ['offer'=>$offer['name'], 'code' => $this->hashids->encode([$recipient['id'], $offer['id']])];
        });
    }
}
