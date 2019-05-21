<?php
use App\Repositories\Collection\RecipientRepository;
use Faker\Factory;

class RecipientServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public $recipientService;
    public $recipientRepository;
    public $faker;

    public static function setUpBeforeClass() : void {
        unset(container()['RecipientRepository']);
        container()['RecipientRepository'] = function ($container) {
            return new RecipientRepository();
        };
    }

    protected function _before()
    {
        $this->faker = Factory::create();
        $this->recipientRepository = container()->get('RecipientRepository');
        $this->recipientService = container()->get('RecipientService');
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


}
