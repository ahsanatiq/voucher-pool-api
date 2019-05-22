<?php
namespace App\Services;

use Slim\Container;
use App\Repositories\Contracts\RecipientRepositoryInterface;
use App\Repositories\Contracts\OfferRepositoryInterface;

class VoucherService extends BaseService
{
    private $VoucherRepository;

    public function __construct(Container $container)
    {
        $this->VoucherRepository = $container->get('VoucherRepository');
    }

    public function getAllUsedOffers($recipientId)
    {
        $vouchers = $this->VoucherRepository->getByRecipient($recipientId);
        return array_column($vouchers, 'offer_id');
    }

    public function saveCode(RecipientRepositoryInterface $recipient, OfferRepositoryInterface $offer, $code)
    {
        return $this->VoucherRepository->create([
            'recipient_id' => $recipient['id'],
            'offer_id' => $offer['id'],
            'code' => $code,
        ]);
    }

}
