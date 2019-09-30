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
        fopen(ABSPATH."delete_test_file.txt", "w");

        // now try to delete it
        $this->assertTrue($file_manager_instance->deleteItem(ABSPATH."delete_test_file.txt"));

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

    public function testGivenUnAuthorisedUserDontAllowToRename() {

        $file_manager_instance = new NewwayFileManager(new User("foo@gmail.com", "foo", AccessLevel::ReadOnly));

        $this->assertFalse($file_manager_instance->renameItem("foo.txt", "foo.png"));


    }

    public function givenAuthorisedUserAbleToRenameItem() {
        $rename_test_file_name = ABSPATH."foo.txt";
        $new_file_name = ABSPATH."foo_bar.txt";

        // lets create a file
        fopen($rename_test_file_name, "w");

        $is_renamed = $this->file_manager_instance->renameItem($rename_test_file_name, $new_file_name);
        $this->assertTrue($is_renamed);
        // the below code is for clean up
        // when ending the test, delete this file if it exists
        if (file_exists($rename_test_file_name)) {
            unlink($rename_test_file_name);
        }
        if (file_exists($new_file_name)) {
            unlink($new_file_name);
        }

    }


    public function testGivenMaliciousPathFileManagerShouldNotPerformOperation() {

        // malicious file path
        $malicious_file_path = "/";

        $this->assertFalse($this->file_manager_instance->pathSecurityCheck($malicious_file_path));

    }

    public function testGivenMaliciousFilePathAlongWithRootShouldNotPerformOperation() {
        //malicious file path 2
        $malicious_file_path = SERVER_ROOT."../../";
        $this->assertFalse($this->file_manager_instance->pathSecurityCheck($malicious_file_path));
    }

    public function testGivenMaliciousFilePathWithNoRootOperationShouldNotBePerformed() {
         $malicious_file_path = "/home/naveen/Desktop/foo/";
         $this->assertFalse($this->file_manager_instance->pathSecurityCheck($malicious_file_path));

    }

    public function testGivenUrlEncodedMaliciousFilePathOperationShouldNotBePerformed() {
        $malicious_file_path = SERVER_ROOT."../";
        $this->assertFalse($this->file_manager_instance->pathSecurityCheck($malicious_file_path));

    }

    public function testGivenSpecialCharactersInPathOperationShouldNotBePerformed() {
        $malicious_file_path = SERVER_ROOT."..%2f..%2f";
        $this->assertFalse($this->file_manager_instance->pathSecurityCheck($malicious_file_path));        
    }



    public function testGivenValidPathAllowUserToPerformOperation() {
        $correct_file_path = SERVER_ROOT."foo";
        $this->assertTrue($this->file_manager_instance->pathSecurityCheck($correct_file_path));
    }

}
