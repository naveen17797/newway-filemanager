<?php 

define( 'ABSPATH', dirname(dirname(__FILE__)) . '/' );

abstract class AccessLevel {
	const NoAccess = -1;
	const ReadOnly = 0;
	const ReadWrite = 1;
	const ReadWriteDelete = 2;
	const Admin = 3;
}


class User {

	public function __construct(string $email, string $password, int $access_level) {

		$this->access_level = $access_level;
		$this->email = $email;
		$this->password = $password;

	}

	public function canReadFiles() {

		return ($this->access_level == AccessLevel::ReadOnly ||
				$this->access_level == AccessLevel::ReadWrite ||
				$this->access_level == AccessLevel::ReadWriteDelete ||
				$this->access_level == AccessLevel::Admin);

	}

	public function canWriteFiles() {

		return ($this->access_level == AccessLevel::ReadWrite ||
				$this->access_level == AccessLevel::ReadWriteDelete ||
				$this->access_level == AccessLevel::Admin);
	}

	public function canDeleteFiles() {

		return ($this->access_level == AccessLevel::ReadWriteDelete ||
				$this->access_level == AccessLevel::Admin);
	}

	public function canAddUsers() {
		return $this->access_level == AccessLevel::Admin;
	}
	
}

interface UserDataManager {

	public function getUser(string $email, string $password):?User;

	public function insertUser(User $user):bool;

	public function save():bool;
}



class JsonUserDataManager implements UserDataManager {

	public function __construct($json_file_name="") {
		$this->json_file_name = "newway_users.json";
		if ($json_file_name != "") {
			$this->json_file_name = $json_file_name;	
		}

		$this->full_file_path = ABSPATH.$this->json_file_name;
		$this->user_data = array();

		// check if file is present
		if (file_exists($this->full_file_path)) {
			$file_pointer = fopen($this->full_file_path, "w+");
			if ($file_pointer) {
			}
			else {
				throw new Exception("Unable to create flat file database, please give correct
					permissions for newway to work properly");
			}
		}
	}

	public function getUser(string $email, string $password):?User {

		return null;

	}
	

	public function insertUser(User $user):bool {
       
       return false;
    
    }

    public function save():bool {

    }


}



?>