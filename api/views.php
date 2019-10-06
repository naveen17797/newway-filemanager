<?php

require 'all_classes.php';

abstract class FileManagerState {
	const FirstTimeInstallation = 10;
	const LoggedIn = 11;
	const NotAuthenticated = 12;
}


abstract class LoginError {
	const EmailIncorrect = 13;
	const PasswordIncorrect = 14;
}
$action = $_REQUEST['action'];

if ($action == "register_new_user") {

	if (isset($_POST['email'], $_POST['password'], $_POST['access_level'])) {

		if (!empty($_POST['email']) && !empty($_POST['password'])
			&& !empty($_POST['access_level'])) {

			$user_data_manager = JsonUserDataManager::getInstance();
	        $user_to_be_registered = new User($_POST['email'], $_POST['password'], $_POST['access_level']);
	        echo $user_data_manager->insertUser($user_to_be_registered);

		}

	}
}

if ($action == "get_current_status") {
	// check if login is needed, or show new install registration
	// screen, inform this status to client to render components
	$return_code = null;
	$user_data_manager = JsonUserDataManager::getInstance();
	if (SessionUser::getCurrenUserInstance() != null) {
		$return_code = FileManagerState::LoggedIn;
	}
	else if (!$user_data_manager->checkIfAdminUserPresent()) {
		// user not logged in, check if first time installation
		$return_code = FileManagerState::FirstTimeInstallation;
	}
	else {
		$return_code = FileManagerState::NotAuthenticated;
	}

	echo json_encode(array("return_code"=>$return_code));
}

if ($action == "login_user") {

	if (isset($_POST['email'], $_POST['password'])) {
		$return_code = null;
		$user_data_manager = JsonUserDataManager::getInstance();
		$logged_in_user = $user_data_manager->getUser($_POST['email'], $_POST['password']);
		if ($logged_in_user != null) {
			if ($logged_in_user->userShouldBeAllowedToLogin()) {
				echo FileManagerState::LoggedIn;
			}
			else {
				echo LoginError::PasswordIncorrect;
			}
		}
		else {
			echo LoginError::EmailIncorrect;
		}
	}
}


if ($action == "get_files") {

	$directory = $_POST['directory'];

	if ($directory == "") {
		// use root directory
		$directory = SERVER_ROOT;
	}
	$current_user_instance = SessionUser::getCurrenUserInstance();
	if ($current_user_instance != null) {
		$file_manager = new NewwayFileManager($current_user_instance);
		echo json_encode($file_manager->getFilesAndFolders($directory));
	}
	else {
		echo FileManagerState::NotAuthenticated;
	}


}


if ($action == "upload_files") {

	$directory = $_POST['directory'];

	if ($directory == "") {
		// use root directory
		$directory = SERVER_ROOT;
	}
	$current_user_instance = SessionUser::getCurrenUserInstance();
	if ($current_user_instance != null) {
		$file_manager = new NewwayFileManager($current_user_instance);
		$file_manager->uploadFiles($directory);
	}
	else {
		echo FileManagerState::NotAuthenticated;
	}


}

if ($action == "logout_user") {
	session_unset();
}

if ($action == "rename_item") {

	$old_name = $_POST['old_name'];
	$new_name = $_POST['new_name'];

	if (!empty($old_name) && !empty($new_name)) {
		$current_user_instance = SessionUser::getCurrenUserInstance();
		if ($current_user_instance != null) {
			$file_manager_instance = new NewwayFileManager($current_user_instance);
			$is_renamed = $file_manager_instance->renameItem($old_name, $new_name);
			echo json_encode(array("new_name"=>$new_name, "is_renamed"=>$is_renamed));
		}
		else {
			echo FileManagerState::NotAuthenticated;
		}



	}
}

if ($action == "add_new_user") {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$access_level = $_POST['access_level'];
	$user_data_manager = JsonUserDataManager::getInstance();
	$user_to_be_registered = new User($email, $password, $access_level);
    $is_user_registration_success = $user_data_manager->insertUser($user_to_be_registered);
    echo json_encode(array("is_user_registration_success"=> $is_user_registration_success));
}

if ($action == "get_users") {
	$user_data_manager = JsonUserDataManager::getInstance();
	echo json_encode($user_data_manager->getAllUsers());
}

if ($action == "get_current_logged_in_user") {
	$current_user_instance = SessionUser::getCurrenUserInstance();
	if ($current_user_instance != null) {

		echo json_encode(
			array(
				"email"=>$current_user_instance->email,
				"can_read_files"=>$current_user_instance->canReadFiles(),
				"can_write_files"=>$current_user_instance->canWriteFiles(),
				"can_delete_files"=>$current_user_instance->canDeleteFiles(),
				"can_add_users"=>$current_user_instance->canAddUsers(),
				"allowed_directories"=>$current_user_instance->getAllowedDirectories(),
			)
		);
	}
}

if ($action == "delete_items") {

	$file_list = $_POST['file_list'];

	$current_user_instance = SessionUser::getCurrenUserInstance();

	if ($current_user_instance != null) {
		
		$file_manager_instance = new NewwayFileManager($current_user_instance);

		$file_folder_item_statistics = array();

		foreach($file_list as $file_folder_item) {	

			$single_file_folder_item_statistics = array();

			$is_deleted = $file_manager_instance->deleteItem($file_folder_item);
			
			$single_file_folder_item_statistics['name'] = $file_folder_item;

			$single_file_folder_item_statistics['is_deleted'] = $is_deleted;

			array_push($file_folder_item_statistics, $single_file_folder_item_statistics);
		}

		echo json_encode($file_folder_item_statistics);

	}
	else {
		echo FileManagerState::NotAuthenticated;
	}

}

?>