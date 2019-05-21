<?php
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

    public static function setUpBeforeClass() : void {
        unset(container()['OfferRepository']);
        container()['OfferRepository'] = function ($container) {
            return new \App\Repositories\Collection\OfferRepository();
        };
        unset(container()['RecipientRepository']);
        container()['RecipientRepository'] = function ($container) {
            return new \App\Repositories\Collection\RecipientRepository();
        };
        unset(container()['VoucherRepository']);
        container()['VoucherRepository'] = function ($container) {
            return new \App\Repositories\Collection\VoucherRepository();
        };

    }

    protected function _before()
    {
        $this->faker = Factory::create();
        $this->OfferRepository = container()->get('OfferRepository');
        $this->RecipientRepository = container()->get('RecipientRepository');
        $this->VoucherRepository = container()->get('VoucherRepository');
        $this->OfferService = container()->get('OfferService');
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
        $this->expectExceptionMessage('{"name":["The name field is required."],"discount":["The discount field is required."],"expiration_date":["The expiration date field is required."]}');
        $this->OfferService->create([]);
    }

    public function testValidationDiscountRequiredForCreateOffer()
    {
        $this->expectExceptionMessage('{"discount":["The discount field is required."],"expiration_date":["The expiration date field is required."]}');
        $this->OfferService->create(['name'=>'offer1']);
    }

    public function testValidationDateRequiredForCreateOffer()
    {
        $this->expectExceptionMessage('{"expiration_date":["The expiration date field is required."]}');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'5']);
    }

    public function testValidationDiscountShouldBeNumericForCreateOffer()
    {
        $this->expectExceptionMessage('{"discount":["The discount must be a number."]}');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'abc', 'expiration_date'=>'2020-05-21']);
    }

    public function testValidationDateFormatForCreateOffer()
    {
        $this->expectExceptionMessage('{"expiration_date":["The expiration date is not a valid date.","The expiration date must be a date after today."]}');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'0', 'expiration_date'=>'20gghjh200202x0202']);
    }

    public function testValidationDiscountMaxForCreateOffer()
    {
        $this->expectExceptionMessage('{"discount":["The discount must be between 0 and 100."]}');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'101', 'expiration_date'=>'2020-05-05']);
    }

    public function testValidationDateShouldBeFutureForCreateOffer()
    {
        $this->expectExceptionMessage('{"expiration_date":["The expiration date must be a date after today."]}');
        $this->OfferService->create(['name'=>'offer1', 'discount'=>'5', 'expiration_date'=>'2019-05-21']);
    }

    public function testValidCreateOffer()
    {
        $user = ['name'=>$this->faker->name, 'email'=>$this->faker->email];
        $user = $this->RecipientRepository->create($user);

        $offer = ['name'=>'offer1', 'discount'=>'5', 'expiration_date'=>'2025-05-21'];
        $this->OfferService->create($offer);
        $offers = $this->OfferService->getAll();
        codecept_debug($offers);
        $this->assertSame($offer, array_intersect($offer, $offers[count($offers)-1]));
        $vouchers = $this->VoucherRepository->getAll();
        codecept_debug($vouchers);
        
    }




}
