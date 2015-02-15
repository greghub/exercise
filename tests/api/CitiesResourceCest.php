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
/*
    # GET companies/$uuid
    public function getSingleCompany(ApiTester $I)
    {     
        # login
        $I->amHttpAuthenticated('user@user.com','password');
        # get   
        $my = $I->grabRecord('companies', array('name' => 'Duraflex')); 
        $I->sendGET($this->endpoint . $my->uuid);  
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => 'All OK']);
    }

    # POST companies/
    # @param $company_id, $email, $password, $name, $type_id
    public function createCompany(ApiTester $I)
    {
        # login
        $I->amHttpAuthenticated('user@user.com','password');
        # create companys
        $companys = $I->sendPOST($this->endpoint, ['name' => 'Company', 'type' => '1', 'address' => '7 high road', 'contact_email' => 'company@company.com']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['result' => 'Company successfully created']);
        # check if created        
        $I->sendGET($this->endpoint . $companys);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['name' => 'Company']);
    }

    # PUT companies/$uuid
    # @param $company_id, $email, $password, $name, $type_id
    public function updateCompany(ApiTester $I)
    {
        # login
        $I->amHttpAuthenticated('user@user.com','password');
        # get user        
        $company = $I->grabRecord('companies', array('name' => 'Duraflex'));
        # update      
        $I->sendPUT($this->endpoint . $company->uuid, ['archived' => '0', 'name' => 'Test', 'type' => '1']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['result' => 'Company successfully updated']);
    }

    # DELETE companies/$uuid
    public function deleteCompany(ApiTester $I)
    {
        # login     
        $I->amHttpAuthenticated('user@user.com','password');
        $company = $I->grabRecord('companies', array('name' => 'Duraflex'));
        # delete
        $I->sendDELETE($this->endpoint . $company->uuid);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->dontSeeRecord('companies', ['uuid' => $company->uuid]);
    }
*/
}