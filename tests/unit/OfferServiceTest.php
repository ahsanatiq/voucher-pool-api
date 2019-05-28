<?php
namespace Tests;

use Faker\Factory;

class OfferServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $OfferService;
    public $OfferRepository;
    public $RecipientRepository;
    public $VoucherRepository;
    public $faker;

    public static function setUpBeforeClass() : void
    {
    //
    }

    protected function _before()
    {
        $this->faker = Factory::create();
        $this->OfferRepository = container('OfferRepository');
        $this->OfferService = container('OfferService');
    }

    // tests
    public function testCanInitialize()
    {
        $this->assertInstanceOf(
            \App\Services\OfferService::class,
            $this->OfferService
        );
    }

    public function testValidationAllRequiredForCreateOffer()
    {
        $this->expectExceptionMessage('Params required.');
        $this->OfferService->create([]);
    }

    public function testValidationDiscountRequiredForCreateOffer()
    {
        $this->expectExceptionMessage('The discount field is required.');
        $this->OfferService->create(['name'=>'offer1']);
    }

    public function testValidationDateRequiredForCreateOffer()
    {
        $this->expectExceptionMessage('The expire at field is required.');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'5']);
    }

    public function testValidationDiscountShouldBeNumericForCreateOffer()
    {
        $this->expectExceptionMessage('The discount must be a number.');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'abc', 'expire_at'=>'2020-05-21']);
    }

    public function testValidationDateFormatForCreateOffer()
    {
        $this->expectExceptionMessage('The expire at is not a valid date.');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'0', 'expire_at'=>'20gghjh200202x0202']);
    }

    public function testValidationDiscountMaxForCreateOffer()
    {
        $this->expectExceptionMessage('The discount must be between 0 and 100.');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'101', 'expire_at'=>'2020-05-05']);
    }

    public function testValidationDateShouldBeFutureForCreateOffer()
    {
        $this->expectExceptionMessage('The expire at must be a date after today');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'5', 'expire_at'=>'2019-05-21']);
    }

    public function testValidCreateOffer()
    {
        $offer = ['name'=>'offer1', 'discount'=>'5.00', 'expire_at'=>'2025-05-21'];
        $result = $this->OfferService->create($offer);

        $offers = $this->OfferService->getAll();
        $this->assertSame($offer, array_intersect($offer, $offers[count($offers)-1]));
    }

    public function testGetAllActiveOffers()
    {
        // it service won't let me add offers whose expiring today or past
        // so adding these offers manually using repository
        $offer = ['name'=>'offer1', 'discount'=>'5.00', 'expire_at'=>'1947-05-21'];
        $this->OfferRepository->create($offer);

        $offer = ['name'=>'offer2', 'discount'=>'10.00', 'expire_at' => date('Y-m-d')];
        $this->OfferRepository->create($offer);

        $offer = ['name'=>'offer3', 'discount'=>'15.00', 'expire_at' => date('Y-m-d', strtotime('tomorrow'))];
        $this->OfferService->create($offer);

        $offers = $this->OfferService->getAllActive();
        $this->assertNotFalse($offers->pluck('name')->contains('offer3'), '"offer3" is not found in array');
    }
}
