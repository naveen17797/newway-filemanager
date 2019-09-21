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
        $this->user_data_manager = new JsonUserDataManager();
    }

    public function testWhenNoUserPresentAbleToRegisterAsAdminUser() {

        $user_to_be_registered = new User("foo@gmail.com", "foo", AccessLevel::Admin);
        $this->user_data_manager->insertUser($user_to_be_registered);
        // since user is registered we need to get it back
        $this->user_data_manager->getUser("foo@gmail.com", "foo");
    }

    protected function _after()
    {
    }

}