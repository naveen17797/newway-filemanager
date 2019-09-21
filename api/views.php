<?php

require 'all_classes.php';

abstract class FileManagerState {
	const FirstTimeInstallation = 10;
	const LoggedIn = 11;
	const NotAuthenticated = 12;
}

$action = $_POST['action'];

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
	

?>