<?php 
session_start();
define( 'ABSPATH', dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
define( 'SERVER_ROOT', dirname(ABSPATH).DIRECTORY_SEPARATOR);

abstract class AccessLevel {
	const NoAccess = -1;
	const ReadOnly = 0;
	const ReadWrite = 1;
	const ReadWriteDelete = 2;
	const Admin = 3;
}


class User {

	public function __construct(string $email, string $hashed_password, int $access_level, ?string $unhashed_password=null) {

		$this->access_level = $access_level;
		$this->email = $email;
		$this->password = $hashed_password;
		$this->unhashed_password = $unhashed_password;
	}

	public function getPasswordHash() {
		return password_hash($this->password, PASSWORD_DEFAULT);
	}

	public function userShouldBeAllowedToLogin() {
		if ($this->unhashed_password != null) {
			$_SESSION['email'] = $this->email;
			$_SESSION['password'] = $this->unhashed_password;
			return password_verify($this->unhashed_password, $this->password);
		}
		else {
			return false;
		}
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
	public static function getCurrenUserInstance($json_file_name="") {

		if (self::$current_user_instance == null) {
			if (isset($_SESSION['email'], $_SESSION['password'])) {
				self::$current_user_instance = JsonUserDataManager::getInstance($json_file_name)->getUser($_SESSION['email'], $_SESSION['password']);
			}
		}

		return self::$current_user_instance;

	}

}

interface UserDataManager {

	public function getUser(?string $email, ?string $password):?User;

	public function insertUser(User $user):bool;

	public function save():bool;

	public function checkIfAdminUserPresent():bool;
}



class JsonUserDataManager implements UserDataManager {

	static $user_data_manager_instance = null;

	public static function getInstance($json_file_name=""):JsonUserDataManager {

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
			$file_pointer = fopen($this->full_file_path, "r");
			
			try {
				if ($file_pointer) {
					$this->user_data = json_decode(fread($file_pointer, 
						filesize($this->full_file_path)), true);

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

	public function getUser(?string $email, ?string $supplied_password):?User {

		if (array_key_exists($email, $this->user_data)) {

			$single_user_data = $this->user_data[$email];

			return new User($single_user_data['email'], $single_user_data['password'], $single_user_data['access_level'], $supplied_password);
		}
		else {

			return null;
		}

	}

	public function getAllUsers() {
		return $this->user_data;
	}
	

	public function insertUser(User $user):bool {

		// first check if there are any user present in current db
		// if there are not then it is first time installation
		if (count($this->user_data) > 0) {

			// then check if the user has the permission to 
			// add the new user
			$current_user_instance = SessionUser::getCurrenUserInstance();
			if ($current_user_instance == null) {
				// unauthorised login access, so return false
				return false;
			}
			else {
				// check for access level
				// and also check for duplicate email address
				if ($current_user_instance->canAddUsers() &&
					$current_user_instance->email != $user->email) {
					// has access
					return $this->constructArrayAndSaveToDb($user);
				}
				else {
					return false;
				}
			}

		}
		else {
			// new user first installation, simply register
			return $this->constructArrayAndSaveToDb($user);
		}
    	
    }

    private function constructArrayAndSaveToDb($user) {
    		// allow user to be registered
			$this->user_data[$user->email] = array(
													"email"=>$user->email,
													"password"=>$user->getPasswordHash(),
													"access_level"=>$user->access_level
												);
			// and call save
    		return $this->save();
    }

    public function save():bool {
    	$file_contents = json_encode($this->user_data);
		$file_pointer = fopen($this->full_file_path, "w+");
		return fwrite($file_pointer, $file_contents) > 0;

    }

    public function checkIfAdminUserPresent():bool {

    	if (count($this->user_data) > 0) {
    		$users = $this->user_data;
    		foreach ($users as $user) {
    			if ($user['access_level'] == AccessLevel::Admin) {
    				return true;
    				break;
    			}
    		}
    		return false;
    	}
    	else {
    		return false;
    	}
    }


}



class NewwayFileManager {

	public function __construct($current_logged_in_user_instance) {

		$this->current_logged_in_user_instance = $current_logged_in_user_instance;
	}

	public function getFilesAndFolders($directory):?array {
		if ($this->current_logged_in_user_instance->canReadFiles()) {
			$files_and_folders = array();
			$files = new DirectoryIterator($directory);
			foreach ($files as $file_info) {
				if (!$file_info->isDot()) {
					$single_file_info_array = array();
					$single_file_info_array['name'] = $file_info->getFilename();
					$single_file_info_array['size'] = $file_info->getSize();
					$single_file_info_array['is_directory'] = $file_info->isDir();
					$single_file_info_array['extension'] = $file_info->getExtension();
					$single_file_info_array['last_modified_time'] = $file_info->getCTime();
					$single_file_info_array['full_location'] = $directory.$file_info->getFilename();
					$single_file_info_array['location_without_item_name'] = $directory;
					$single_file_info_array['is_editable'] = false;
					if ($file_info->isDir()) {
						// if directory add a directory separator to end
						$single_file_info_array['full_location'] = $directory.$file_info->getFilename().DIRECTORY_SEPARATOR;
					}
					$single_file_info_array['is_selected'] = false;
					array_push($files_and_folders, $single_file_info_array);
				}
			}
			return $files_and_folders;
		}
		else {
			return null;
		}
		
	}
	
	// recursively deletes if it is a folder,
	// unlink if it is a file
	private function deleteFileOrFolder($item) {
		if (is_file($item)) {
			// try to unlink the file
			return unlink($item);
		}
		else if (is_dir($item)) { 
			$di = new RecursiveDirectoryIterator($item, FilesystemIterator::SKIP_DOTS);
			$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
			foreach ( $ri as $file ) {
			    $file->isDir() ?  rmdir($file) : unlink($file);
			}
		}
		return rmdir($item); 
		 
	}

	// deletes a file or folder based on the user access level
	public function deleteItem($item) {
		if ($this->current_logged_in_user_instance->canDeleteFiles()) {
			return $this->deleteFileOrFolder($item);
		}
		else {
			return false;
		}
	}


	public function renameItem($oldname, $newname) {
		if ($this->current_logged_in_user_instance->canWriteFiles()) {
			return rename($oldname, $newname);
		}
		else {
			return false;
		}
	}

	private function isRootDirectoryPresentInStartingOfPath($path) {

		$root_path_length = strlen(SERVER_ROOT);

		$current_root_path = substr($path, 0, $root_path_length);

		return SERVER_ROOT == $current_root_path;


	}

	public function pathSecurityCheck($path) {
		// check if the path lies in our root
		if (strlen($path) >= strlen(SERVER_ROOT)) {

			if (strpos($path, '../') !== false){
				// this is attempting to go outside of root directory
				return false;
			}
			else {

				return $this->isRootDirectoryPresentInStartingOfPath($path);

			}

		}
		else {
			return false;
		}
	}	
}

?>