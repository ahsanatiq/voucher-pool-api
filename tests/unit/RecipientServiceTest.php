<?php
use Faker\Factory;

class RecipientServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $recipientService;
    public $recipientRepository;
    public $OfferService;
    public $faker;

    public static function setUpBeforeClass() : void {
    //
    }

    protected function _before()
    {
        $this->faker = Factory::create();
        $this->recipientRepository = container('RecipientRepository');
        $this->recipientService = container('RecipientService');
        $this->OfferService = container('OfferService');
    }

    // tests
    public function testCanInitialize()
    {
        $this->assertInstanceOf(
            \App\Services\RecipientService::class,
            $this->recipientService
        );
    }

    public function testGetRecipient()
    {
        $user = ['name'=>$this->faker->name, 'email'=>$this->faker->email];
        $this->recipientRepository->create($user);
        $recipients = $this->recipientService->getAll();
        $this->assertSame($user, array_intersect($user,$recipients[count($recipients)-1]));
    }

    public function testGetVouchers()
    {
        $user = $this->recipientRepository->create(['name'=>$this->faker->name, 'email'=>$this->faker->email]);
        $offer = $this->OfferService->create(['name'=>'offer123', 'discount'=>'10.00', 'expire_at'=>'2020-05-21']);

        $vouchers = $this->recipientService->getVouchers($user['email']);
        $this->assertNotEmpty($vouchers);
        $vouchers = array_values($vouchers);
        $offer123 = array_search('offer123', array_column($vouchers, 'offer'));
        $this->assertNotFalse($offer123, '"offer123" is not found in array');
        $offer123 = $vouchers[$offer123];

        $hashids = container('hashids');
        $decoded = $hashids->decode($offer123['code']);
        $this->assertNotEmpty($decoded);
        $encoded = [$user['id'], $offer['id']];
        $this->assertSame($decoded, $encoded);
        $newDecoded = $hashids->encode($encoded);
        $this->assertSame($newDecoded, $offer123['code']);
    }
}
