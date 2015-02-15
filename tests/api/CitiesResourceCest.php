<?php
use \ApiTester;

class CitiesResourceCest
{
    protected $endpoint = '/v1/states/cities.json';

    // tests

    # GET cities/   
    public function getCitiesByState(ApiTester $I)
    {
        # login
        //$I->amHttpAuthenticated('user@user.com','password');
        # get all users to test  
        $I->sendGET($this->endpoint . "?state=IL");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'All OK']);
    }

    # GET cities/   
    public function getCitiesInRadius(ApiTester $I)
    {
        # login
        //$I->amHttpAuthenticated('user@user.com','password');
        # get all users to test  
        $I->sendGET($this->endpoint . "?city=Chicago&radius=1");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'All OK']);
    }

}