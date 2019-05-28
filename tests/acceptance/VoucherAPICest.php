<?php
namespace Tests;

use Faker\Factory;
use AcceptanceTester;
use Codeception\Util\HttpCode;
use Codeception\Util\JsonArray;

class VoucherAPICest
{
    protected $faker;
    protected $restModule;

    public function _before(AcceptanceTester $I)
    {
        $this->faker = Factory::create('en_US');

        $I->haveHttpHeader('APP_ENV', 'testing');
        $I->haveHttpHeader('Accept', 'application/json');
    }

    public function _inject(\Codeception\Module\REST $restModule)
    {
        $this->restModule = $restModule;
    }

    // tests
    public function TestRecipients(AcceptanceTester $I)
    {
        $users = $this->getRecipients($I);
    }

    public function TestValidationForCreateOffer(AcceptanceTester $I)
    {
        $offerData  = $this->generateOfferData();
        $validations = $this->getValidations();
        foreach ($validations as $validation) {
            $I->sendPOST('/api/v1/offers', array_merge($offerData, [$validation['title'] => $validation['try']]));
            $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
            $I->seeResponseIsJson();
            $I->seeResponseContainsJson([
                'type'    => 'ValidationException',
                'message' => [$validation['message']],
                'code'    => HttpCode::UNPROCESSABLE_ENTITY,
            ]);
        }
    }

    public function TestValidCreateOffer(AcceptanceTester $I)
    {
        $this->createOffer($I);
    }

    public function TestGetVouchers(AcceptanceTester $I)
    {
        // get users
        $users = $this->getRecipients($I);

        // create offer
        $offerData = $this->createOffer($I);

        // see I get back offer in recipient vouchers
        $vouchers = $this->getVouchers($I, $users[0]['email']);
        $foundOffer = array_search($offerData['name'], array_column($vouchers, 'offer'));
        $I->assertNotFalse($foundOffer, 'I could not get back offer code');
    }

    public function TestRedeemVouchers(AcceptanceTester $I)
    {
        // test validations on radeem
        $I->sendPOST('/api/v1/redeem');
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'type'    => 'ValidationException',
            'message' => ['Params required.'],
            'code'    => HttpCode::UNPROCESSABLE_ENTITY,
        ]);

        $I->sendPOST('/api/v1/redeem', ['email'=>'aadfadf2@asdfasdf']);
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'type'    => 'ValidationException',
            'message' => ['The code field is required.'],
            'code'    => HttpCode::UNPROCESSABLE_ENTITY,
        ]);

        $I->sendPOST('/api/v1/redeem', ['email'=>'aadfadf2asdfasdf', 'code'=>'jlakdfl']);
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'type'    => 'ValidationException',
            'message' => ['The email must be a valid email address.'],
            'code'    => HttpCode::UNPROCESSABLE_ENTITY,
        ]);

        $I->sendPOST('/api/v1/redeem', ['email'=>'aadfad@f2asdfasdf', 'code'=>'jlakdfl']);
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'type'    => 'RecipientNotFoundException',
            'message' => 'Recipient not found.',
            'code'    => HttpCode::NOT_FOUND,
        ]);

        // get users
        $users = $this->getRecipients($I);

        // create offer
        $offerData = $this->createOffer($I);

        // see I get back offer in recipient vouchers
        $vouchers = $this->getVouchers($I, $users[0]['email']);
        $vouchers = array_values($vouchers);
        $foundOffer = array_search($offerData['name'], array_column($vouchers, 'offer'));
        $I->assertNotFalse($foundOffer, 'I could not get back offer code');

        // found the code , now lets use it
        list('offer'=>$offer, 'code'=>$code) = $vouchers[$foundOffer];
        $I->sendPOST('/api/v1/redeem', ['email'=>$users[0]['email'], 'code'=>$code]);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['data'=>['discount'=>$offerData['discount']]]);

        // lets radeem again
        $I->sendPOST('/api/v1/redeem', ['email'=>$users[0]['email'], 'code'=>$code]);
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'type'    => 'UsedVoucherCodeException',
            'message' => 'Offer is already used.',
            'code'    => HttpCode::UNPROCESSABLE_ENTITY,
        ]);

    }

    protected function getVouchers(AcceptanceTester $I, $email)
    {
        $I->sendGET('/api/v1/recipients/vouchers', ['email'=>$email]);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesXpath('//data');
        list('data'=>$vouchers) = (new JsonArray($I->grabResponse()))->toArray();
        $I->assertGreaterThan(1, $vouchers);
        return $vouchers;
    }

    protected function createOffer(AcceptanceTester $I)
    {
        $offerData  = $this->generateOfferData();
        $I->sendPOST('/api/v1/offers', $offerData);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['data'=>$offerData]);
        return $offerData;
    }

    protected function getRecipients(AcceptanceTester $I)
    {
        $I->sendGET('/api/v1/recipients');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesXpath('//data');
        list('data'=>$users) = (new JsonArray($I->grabResponse()))->toArray();
        $I->assertGreaterThan(1, $users);
        return $users;
    }

    protected function generateOfferData()
    {
        return [
            'name'      => $this->faker->word(),
            'discount'  => $this->faker->randomFloat(2, 0, 50),
            'expire_at' => date('Y-m-d',strtotime('tomorrow')),
        ];
    }

    protected function getValidations()
    {
        return [
            ['title' => 'name',
            'try' => '',
            'message' => 'The name field is required.'],
            ['title' => 'discount',
            'try' => '',
            'message' => 'The discount field is required.'],
            ['title' => 'expire_at',
            'try' => '',
            'message' => 'The expire at field is required.'],
            ['title' => 'name',
            'try' => $this->faker->text(100) . $this->faker->text(100),
            'message' => 'The name may not be greater than 100 characters.'],
            ['title' => 'discount',
            'try' => $this->faker->text(10),
            'message' => 'The discount must be a number.'],
            ['title' => 'discount',
            'try' => $this->faker->numberBetween(10000, 99999),
            'message' => 'The discount must be between 0 and 100.'],
            ['title' => 'discount',
            'try' => $this->faker->text(10),
            'message' => 'The discount must be a number.'],
            ['title' => 'discount',
            'try' => $this->faker->numberBetween(-10, -1),
            'message' => 'The discount must be between 0 and 100.'],
            ['title' => 'expire_at',
            'try' => $this->faker->text(10),
            'message' => 'The expire at is not a valid date.'],
            ['title' => 'expire_at',
            'try' => '2018-01-01',
            'message' => 'The expire at must be a date after today.'],
        ];
    }
}
