<?php
namespace App\Services;

use Slim\Container;

class VoucherService extends BaseService
{
    private $VoucherRepository;

    public function __construct(Container $container)
    {
        $this->VoucherRepository = $container->get('VoucherRepository');
    }

    public function create($recipients, $offer)
    {
        $vouchers = [];
        foreach ($recipients as $recipient) {
            $vouchers[] = $this->VoucherRepository->create([
                'recipient_id' => $recipient['id'],
                'offer_id' => $offer['id'],
                'code' => strtoupper(substr(md5(rand()), 0, 8)),
            ]);
        }
        return $vouchers;
    }
}
