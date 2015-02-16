<?php
use \ApiTester;

class UsersResourceCest
{
    protected $endpoint = '/v1/users/visits.json';

    // tests

    # GET users/   
    public function getUserVisits(ApiTester $I)
    {
        # login
        //$I->amHttpAuthenticated('user@user.com','password');
        # get all users to test  
        $I->sendGET($this->endpoint . "?user_id=1");
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'All OK']);
    }

    # POST users/   
    public function getCitiesInRadius(ApiTester $I)
    {
        # login
        //$I->amHttpAuthenticated('user@user.com','password');
        # create companys
        $companys = $I->sendPOST($this->endpoint, ['user_id' => '1', 'city' => 'Chicago']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(["result": "Visit successfully updated"]);
        # check if created        
        $I->seeRecord('user_citys', ['user_id' => '1', 'city' => 'Chicago']);
    }

}