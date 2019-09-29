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
}
