<?php 
class LoginTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    private $db_storage_file_name = "test_newway_users.json";
    
    protected function _before()
    {   
        $this->user_data_manager = JsonUserDataManager::getInstance($this->db_storage_file_name);
    }

    protected function _after()
    {
        if (file_exists($this->user_data_manager->full_file_path)) {
            // clean up flat file db 
            unlink($this->user_data_manager->full_file_path);
        }
    }

    private function registerUser() {
        $user_to_be_registered = new User("foo@gmail.com", "foo", AccessLevel::Admin);
        $this->user_data_manager->insertUser($user_to_be_registered);
        return $user_to_be_registered;
    }

    public function testAfterRegisteringUsersAbleToRetrieveThem() {
        $user_to_be_registered = $this->registerUser();
        $this->assertNotNull($this->user_data_manager->getAllUsers());
        $this->assertEquals(1, count($this->user_data_manager->getAllUsers()));
    }

    public function testWhenGivenCorrectCredentialsShouldLogin()
    {
        $user_to_be_registered = $this->registerUser();
        // user registered, trying to login
        $logged_in_user = $this->user_data_manager->getUser($user_to_be_registered->email, $user_to_be_registered->password);
        $this->assertTrue($logged_in_user->userShouldBeAllowedToLogin());

    }

    public function testWhenGivenWrongEmailNoUserShouldReturn() {
        $user_to_be_registered = $this->registerUser();
        // use wrong email
        $logged_in_user = $this->user_data_manager->getUser("wrong@gm", "foo");
        $this->assertNull($logged_in_user);
    }

    public function testWhenGivenWrongPasswordUserShouldNotBeLoggedIn() {
        $user_to_be_registered = $this->registerUser();
        //use wrong password
        $logged_in_user =$this->user_data_manager->getUser($user_to_be_registered->email, "wrong password");
        $this->assertFalse($logged_in_user->userShouldBeAllowedToLogin());
    }



}
