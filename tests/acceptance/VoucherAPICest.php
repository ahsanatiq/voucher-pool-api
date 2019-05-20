<?php
namespace Tests;

use AcceptanceTester;
use Codeception\Util\HttpCode;

class VoucherAPICest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function TestDefaultRoute(AcceptanceTester $I)
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['Hello' => 'world']);
    }
}
