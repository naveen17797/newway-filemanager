<?php 

require __DIR__."/../../api/all_classes.php";

class RegistrationTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->user_data_manager = JsonUserDataManager::getInstance();
    }

    public function testWhenNoUserPresentAbleToRegisterAsAdminUser() {

        $user_to_be_registered = new User("foo@gmail.com", "foo", AccessLevel::Admin);
        $this->user_data_manager->insertUser($user_to_be_registered);
        // since user is registered we need to get it back
        $user_instance = $this->user_data_manager->getUser("foo@gmail.com", "foo");
        $this->assertNotNull($user_instance);
    }

    protected function _after()
    {
    }

}