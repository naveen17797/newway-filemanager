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
		echo json_encode($file_manager->getFilesAndFolders(SERVER_ROOT));
	}
	else {
		return FileManagerState::NotAuthenticated;
	}


}


if ($action == "upload_files") {

	$directory = $_POST['directory'];

	if ($directory == "") {
		// use root directory
		$directory = SERVER_ROOT;
	}
	print_r($_FILES);
	$current_user_instance = SessionUser::getCurrenUserInstance();
	if ($current_user_instance != null) {

            $count=0;
            foreach ($_FILES['file']['name'] as $filename) 
            {
                $temp=$target;
                $tmp=$_FILES['file']['tmp_name'][$count];
                $count=$count + 1;
                $temp=$temp.basename($filename);
                echo move_uploaded_file($tmp,$temp);
                $temp='';
                $tmp='';
            }

	}
	else {
		return FileManagerState::NotAuthenticated;
	}


}
	

?>