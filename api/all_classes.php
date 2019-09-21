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

// a singleton to get the instance of the currently
// logged in user
class SessionUser {
	static $current_user_instance = null;
	// returns current logged in user instance from session
	public function getCurrenUserInstance() {

		if (self::$current_user_instance == null) {
			self::$current_user_instance = JsonUserDataManager::getInstance()->getUser($_SESSION['email'], $_SESSION['password']);
		}

		return self::$current_user_instance;

	}

}

interface UserDataManager {

	public function getUser(string $email, string $password):?User;

	public function insertUser(User $user):bool;

	public function save():bool;
}



class JsonUserDataManager implements UserDataManager {

	static $user_data_manager_instance = null;

	public function getInstance($json_file_name=""):JsonUserDataManager {

		if (self::$user_data_manager_instance == null) {
		 	self::$user_data_manager_instance = new JsonUserDataManager($json_file_name);
		}
		return self::$user_data_manager_instance;
	}

	private function __construct($json_file_name) {
		$this->json_file_name = "newway_users.json";
		if ($json_file_name != "") {
			$this->json_file_name = $json_file_name;	
		}

		$this->full_file_path = ABSPATH.$this->json_file_name;
		$this->user_data = array();
		$this->loadFileContents();

	}

	private function loadFileContents() {

		// check if file is present
		if (file_exists($this->full_file_path)) {
			$file_pointer = fopen($this->full_file_path, "w+");
			
			try {
				if ($file_pointer) {
					$this->user_data = fread($file_pointer, 
						filesize($this->full_file_path));

				}
				else {
					throw new Exception("Unable to create flat file database, please give correct
						permissions for newway to work properly");
				}
			}

			catch(Exception $e) {
				echo $e->getMessage();
			}
		}
	}

	public function getUser(string $email, string $password):?User {

		if (array_key_exists($email, $this->user_data)) {

			$single_user_data = $this->user_data[$email];

			return new User($single_user_data['email'], $single_user_data['password'], $single_user_data['access_level']);

		}
		else {

			return null;
		}

	}
	

	public function insertUser(User $user):bool {

	   array_key_exists($user->email, $this->user_data);
       
       return false;
    
    }

    public function save():bool {

    }


}



?>