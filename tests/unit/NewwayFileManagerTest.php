<?php


class NewwayFileManagerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $file_manager_instance = null;

    private $db_storage_file_name = "test_newway_users.json";
    
    protected function _before()
    {

        $this->file_manager_instance = new NewwayFileManager(new User("foo@gmail.com", "foo", AccessLevel::Admin));
    }


    public function testGivenDirectoryReturnFiles() {

        $this->assertNotNull(array(), $this->file_manager_instance->getFilesAndFolders(SERVER_ROOT));
        
    }

    public function testGivenUnAuthorisedUserShouldReturnNull() {
        $unauthorised_user = new User("foo@gmail.com", "foo", -1);
        $unauthorised_file_manager_instance = new NewwayFileManager($unauthorised_user);
        $this->assertNull($unauthorised_file_manager_instance->getFilesAndFolders(SERVER_ROOT));
    }


    public function testGivenUserWithoutDeletePermissionItShouldNotAllowToDelete() {
        $file_manager_instance = new NewwayFileManager(new User("foo@gmail.com", "foo", AccessLevel::ReadOnly));
        $this->assertFalse($file_manager_instance->deleteItem("foo/"));
    }

    public function testGivenUserWithProperDeletePermissionTheUserShouldBeAbleToDeleteTheFile() {
        $file_manager_instance = new NewwayFileManager(new User("foo@gmail.com", "foo", AccessLevel::ReadWriteDelete));
        // a perfectly normal user with delete access has been created 
    
        // lets create a file 
        fopen("delete_test_file.txt", "w");

        // now try to delete it
        $this->assertTrue($file_manager_instance->deleteItem("delete_test_file.txt"));

        // even if it is not deleted by test, just remove it
        if (file_exists("delete_test_file.txt")) {
            unlink("delete_test_file.txt");
        }    
    }


    public function testGivenUserWithProperDeletePermissionTheUserShouldBeAbleToDeleteTheDirectory() {

        // lets create a directory
        mkdir(ABSPATH."delete_test_dir");

        // create a file inside it
        fopen(ABSPATH."delete_test_dir".DIRECTORY_SEPARATOR."foo.txt", "w");

        $delete_test_file_name = ABSPATH."delete_test_dir".DIRECTORY_SEPARATOR."foo.txt";

        $delete_test_dir_name = ABSPATH."delete_test_dir".DIRECTORY_SEPARATOR;

        codecept_debug(ABSPATH);

        // now check if the user is able to delete a directory with file 
         $this->assertTrue($this->file_manager_instance->deleteItem(ABSPATH."delete_test_dir"));

        if (file_exists($delete_test_file_name)) {
            // delete the file inside it
            unlink($delete_test_file_name);
        }
        if (is_dir($delete_test_dir_name)) {
            // end of the test remove the directory
            rmdir($delete_test_dir_name);

        }
    }
}
