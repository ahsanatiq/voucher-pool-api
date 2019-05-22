<?php
namespace App\Services;

use Slim\Container;

class VoucherService extends BaseService
{
    private $VoucherRepository;
    private $OfferService;
    private $hashids;
    private $usedVouchers;

    public function __construct(Container $container)
    {
        $this->VoucherRepository = $container->get('VoucherRepository');
        $this->OfferService = $container->get('OfferService');
        $this->hashids = $container->get('hashids');
    }

    public function getAllUsedOffers($recipientId)
    {
        $this->usedVouchers = $this->VoucherRepository->getByRecipient($recipientId);
        return array_column($this->usedVouchers, 'offer_id');
    }

    public function validate($code, $recipient)
    {
        $decoded = $this->hashids->decode($code);
        if ($decoded && $decoded[0]==$recipient['id']) {
            return $decoded;
        }
        throw new \Exception('Invalid code');
    }

    public function saveCode($recipient, $offer, $code)
    {
        return $this->VoucherRepository->create([
            'recipient_id' => $recipient['id'],
            'offer_id' => $offer['id'],
            'code' => $code,
        ]);
    }

    public function redeem($code, $recipient)
    {
        list($recipientId, $offerId) = $this->validate($code, $recipient);
        $offer = $this->OfferService->getById($offerId);
        $usedOffersIds = $this->getAllUsedOffers($recipientId);
        if(in_array($offerId, $usedOffersIds)) {
            throw new \Exception('Offer is already used');
        }
        $this->saveCode($recipient, $offer, $code);
        return $offer;
    }

}
