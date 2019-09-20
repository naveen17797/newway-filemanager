<?php 

require_once 'class.JsonUserDataManager.php';

abstract class AccessLevel {
	const NoAccess = -1;
	const ReadOnly = 0;
	const ReadWrite = 1;
	const ReadWriteDelete = 2;
	const Admin = 3;
}



class Authorisation {

	// $is_authorised is used to check if the username
	// and the password of the given user is correct
	// if correct then set the session on outside handler
	// and get the access level from this class
	private $is_authorised = false;
	

	// access level indicates whether the user can 
	// read, write, delete files and can add other users
	// Admin is a superuser who can do all functionalities
	// such as read, write, delete as well as add users.
	private $access_level = AccessLevel::NoAccess;

	// user data manager is a interface used to access the 
	// user data, it can return the user based on 
	// email and password and also has access levels
	private $user_data_manager = null;

	public function __construct(string $email, string $password, UserDataManager $userDataManager) {
	
		$this->user_data_manager = $userDataManager;
		$this->email = $email;
		$this->password = $password;	
	}

	public function isUserAuthorised() {
		return $this->user_data_manager->getUserData($this->email, $this->password) != null;
	}
}


?>