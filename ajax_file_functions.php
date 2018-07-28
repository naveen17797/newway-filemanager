<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'lib/class.file_functions.php';
$fileFunctions = new fileFunctions();
if (isset($_SESSION)) {
	if (!empty($_SESSION['newway_user_is_admin']) && !empty($_SESSION['newway_user_read_access']) && !empty($_SESSION['newway_user_create_access']) && !empty($_SESSION['newway_user_delete_access'])) {
		//do nothing continue work
	}
	else {
		exit("Please Login to the application");
	}
}



$newway_user_is_admin = $_SESSION['newway_user_is_admin'];

$newway_user_read_access = $_SESSION['newway_user_read_access'];

$newway_user_create_access = $_SESSION['newway_user_create_access'];

$newway_user_delete_access = $_SESSION['newway_user_delete_access'];

if (isset($_POST['rename_oldname']) && isset($_POST['rename_newname'])) {
	if (!empty($_POST['rename_oldname']) && !empty($_POST['rename_newname'])) {
		if ($newway_user_create_access) {
			$oldname = $_POST['rename_oldname'];
			$newname = $_POST['rename_newname'];
			try {
				rename($oldname, $newname);
				echo "1";
			}
			catch(Exception $e) {
				echo "Operation Failed, $oldname does not exist in the directory";
			}

		}
		else {
			echo "Error : Insufficient permissions, operations failed";
		}
	}
}

if (isset($_POST['delete_filename'])) {
	if (!empty($_POST['delete_filename'])) {
		if ($newway_user_delete_access) {
			$delete_filename = $_POST['delete_filename'];
			try {
				$fileFunctions->recursiveDelete($delete_filename);
				echo "1";
			}
			catch(Exception $e) {
				echo $e;
			}
		}
		else {
			echo "Error: Operation failed since you dont have delete permissions";
		}
	}
}

if (isset($_POST['new_folder_name'])) {
	if (!empty($_POST['new_folder_name'])) {
		if ($newway_user_create_access) {
			mkdir($_POST['new_folder_name']);
		}
		else {
			echo "Error: Operation failed since you dont have create permissions";
		}

	}
}

?>