<?php

require_once __DIR__.'/../../api/class.Authorisation.php';

class AuthorisationTest extends \Codeception\Test\Unit
{

    /**
     * @var \UnitTester
     */
    protected $tester;
    
    private $authorisation_instance;

    private $mock_user_data_manager;

    protected function _before()
    {
        $this->mock_user_data_manager = new class implements UserDataManager {
            public function getUserData(string $email, string $password): ?User {
                return new User("foo@gmail.com", AccessLevel::Admin);
            }
        };
        
    }


    public function testGivenWrongCredentialsIsAuthorisedShouldBeFalse() {

        $mock_user_no_data_manager = new class implements UserDataManager {
            public function getUserData(string $email, string $password): ?User {
                return null;
            }
        };
        $this->authorisation_instance = new Authorisation("foo", "foo", $mock_user_no_data_manager);
        $this->assertEquals($this->authorisation_instance->isUserAuthorised(), false);
    }


    public function testGivenCorrectCredentialsIsAuthorisedShouldBeTrue() {
        $this->authorisation_instance = new Authorisation("foo", "foo", $this->mock_user_data_manager);
        $this->assertEquals($this->authorisation_instance->isUserAuthorised(), true);
    }

    protected function _after()
    {
    }


}
