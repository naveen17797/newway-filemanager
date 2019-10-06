<?php 

require __DIR__."/../../api/all_classes.php";

class RegistrationTest extends \Codeception\Test\Unit
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

    public function testWhenNoUserPresentAbleToRegisterAsAdminUser() {

        $user_to_be_registered = new User("foo@gmail.com", "foo", AccessLevel::Admin);
        $this->user_data_manager->insertUser($user_to_be_registered);
        // since user is registered we need to get it back
        $user_instance = $this->user_data_manager->getUser("foo@gmail.com", "foo");
        $this->assertNotNull($user_instance);
        $this->assertEquals($user_instance->email, $user_to_be_registered->email);
    }

    public function testWhenAdminUserPresentTryingToRegisterAsAdminUser() {
        $user_to_be_registered = new User("foo@gmail.com", "foo", AccessLevel::Admin);
        $this->user_data_manager->insertUser($user_to_be_registered);
        // the user is registered, we try to re register it and 
        // observe the result, it should return false
        $result = $this->user_data_manager->insertUser($user_to_be_registered);
        $this->assertFalse($result);
    }

    public function testWhetherTheNonAdminUserCanBeAddedWithAllowedDirectories() {
        //mkdir(ABSPATH."delete_test_dir");
        SessionUser::$current_user_instance = new User("aa@gmail.com", "aa", AccessLevel::Admin);

        $user_to_be_registered = new User("foo@gmail.com", "foo", AccessLevel::ReadWriteDelete, null, [ABSPATH."delete_test_dir"]);
        // while saving the user we need to check if the paths are valid.
        $this->user_data_manager->insertUser($user_to_be_registered);
        $user_instance = $this->user_data_manager->getUser("foo@gmail.com", "foo");
        $this->assertEquals($user_instance->getAllowedDirectories(), [ABSPATH."delete_test_dir"]);
        //rmdir(ABSPATH."delete_test_dir");
    }

    protected function _after()
    {
        if (file_exists($this->user_data_manager->full_file_path)) {
            // clean up flat file db 
            unlink($this->user_data_manager->full_file_path);
        }
    }

}