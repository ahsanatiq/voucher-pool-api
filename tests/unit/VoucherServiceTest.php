<?php
namespace Tests;

use Faker\Factory;

class VoucherServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $faker;

    protected function _before()
    {
        $this->faker = Factory::create();
        $this->recipientRepository = container('RecipientRepository');
        $this->recipientService = container('RecipientService');
        $this->OfferService = container('OfferService');
        $this->VoucherService = container('VoucherService');
    }

    // tests
    public function testCanInitialize()
    {
        $this->assertInstanceOf(
            \App\Services\VoucherService::class,
            $this->VoucherService
        );
    }

    public function testRedeemWithInvalidCode()
    {
        $this->expectExceptionMessage('Invalid code');
        $this->VoucherService->redeem('JzMOsBN', 'test@test.com');
    }

    public function testRedeemWithInvalidReciepient()
    {
        list($user, $offer, $vouchers) = $this->createVouchers();
        $wrongUser = $this->recipientRepository->create(['name'=>$this->faker->name, 'email'=>$this->faker->email]);
        $this->expectExceptionMessage('Invalid code');
        $this->VoucherService->redeem($vouchers[0]['code'], $wrongUser);
    }

    public function testRedeem()
    {
        list($user, $offer, $vouchers) = $this->createVouchers();

        $vouchers = $vouchers->values();
        $offer50 = $vouchers->pluck('offer')->search($offer['name']);
        $this->assertNotFalse($offer50, '"'.$offer['name'].'" is not found in array');
        list('offer'=>$offerName, 'code'=>$voucherCode) = $vouchers[$offer50];

        $offerAfterRedeem = $this->VoucherService->redeem($voucherCode, $user);
        $this->assertNotEmpty($offerAfterRedeem, 'Voucher code is not redeemed');
        $this->assertSame($offer, array_intersect($offer, $offerAfterRedeem));

        // Try to Redeem again
        $this->expectExceptionMessage('Offer is already used');
        $result = $this->VoucherService->redeem($voucherCode, $user);
    }

    public function createVouchers()
    {
        $user = $this->recipientRepository->create(['name'=>$this->faker->name, 'email'=>$this->faker->email]);
        $discount = $this->faker->numberBetween(1, 100);
        $offer = $this->OfferService->create([
            'name'=>'offer '.$discount.' percent',
            'discount'=>$discount,
            'expire_at'=>'2020-05-21'
        ]);
        $vouchers = $this->recipientService->getVouchers($user['email']);
        $this->assertNotEmpty($vouchers);

        return [$user, $offer, $vouchers];
    }
}
