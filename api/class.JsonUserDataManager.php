<?php 

/*
* parses a .json file which contains the user info
* and returns user if the user is available, if it is not 
* then return the corresponding error code
 */
require_once 'interface.UserDataManager.php';



class JsonUserDataManager implements UserDataManager {

	public function __construct() {
		// parse a json file here
	}

	public function getUserData(string $email, string $password):?User {




	}


}