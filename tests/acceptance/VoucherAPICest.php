<?php
namespace Tests;

use AcceptanceTester;
use Codeception\Util\HttpCode;
use Codeception\Util\JsonArray;

class VoucherAPICest
{
    protected $restModule;

    public function _before(AcceptanceTester $I)
    {
        $I->haveHttpHeader('APP_ENV', 'testing');
    }

    public function _inject(\Codeception\Module\REST $restModule)
    {
        $this->restModule = $restModule;
    }

    // tests
    public function TestRecipients(AcceptanceTester $I)
    {
        $I->sendGET('/api/v1/recipients');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesXpath('//data');
        $response = (new JsonArray($I->grabResponse()))->toArray();
        $I->assertCount(30, $response['data']);
    }
}
