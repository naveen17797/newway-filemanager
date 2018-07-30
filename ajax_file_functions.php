<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'lib/class.file_functions.php';
require 'lib/class.json_handler.php';
$fileFunctions = new fileFunctions();
if (isset($_SESSION)) {
	if (!empty($_SESSION['newway_user_is_admin']) && !empty($_SESSION['newway_user_read_access']) && !empty($_SESSION['newway_user_create_access']) && !empty($_SESSION['newway_user_delete_access'])) {
		//do nothing continue work
	}
	else {
		exit("Please Login to the application");
	}
}

$newway_user_email = $_SESSION['authorized_email'];

$newway_user_is_admin = $_SESSION['newway_user_is_admin'];

$newway_user_read_access = $_SESSION['newway_user_read_access'];

$newway_user_create_access = $_SESSION['newway_user_create_access'];

$newway_user_delete_access = $_SESSION['newway_user_delete_access'];

$newway_is_default_login_system = $_SESSION['newway_is_default_login_system'];

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
		$path_info = pathinfo($delete_filename);
		$file_name = $delete_filename['filename'];
		if ($newway_user_delete_access && $filename!="users.json") {
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


if (isset($_POST['add_user_email']) && isset($_POST['add_user_password']) && isset($_POST['add_user_access_level'])) {
	if (!empty($_POST['add_user_email']) && !empty($_POST['add_user_password']) && !empty($_POST['add_user_access_level'])) {
			$email = $_POST['add_user_email'];
			$password = $_POST['add_user_password'];
			$add_user_access_level = $_POST['add_user_access_level'];

		if ($newway_user_is_admin && $newway_is_default_login_system) {

			$jsonHandler = new jsonHandler("../../users.json");
			
			if ($add_user_access_level == "r") {
				$value = array("password"=>password_hash($password,PASSWORD_BCRYPT), "r"=>"1", "c"=>"0", "d"=>"0", "is_admin"=>"false");
			}
			if ($add_user_access_level == "r_c") {
				$value = array("password"=>password_hash($password,PASSWORD_BCRYPT), "r"=>"1", "c"=>"1", "d"=>"0", "is_admin"=>"false");

			}
			if ($add_user_access_level == "r_c_d") {							$value = array("password"=>password_hash($password,PASSWORD_BCRYPT), "r"=>"1", "c"=>"1", "d"=>"1", "is_admin"=>"false");

			}
			
			$value = json_encode($value);
			$jsonHandler->create_key_value($email, $value);
			echo "1";
		}
		else {
			echo "Error: Unable to create user, only admin can add users";
		}

	}

}

if (isset($_POST['get_users_list'])) {
	if (!empty($_POST['get_users_list'])) {
		if ($newway_user_is_admin && $newway_is_default_login_system) {
			$jsonHandler = new jsonHandler("../../users.json");
			$array = $jsonHandler->getAllKeys();
			echo '<table  class="table table-condensed">
			<tr class="heading">
				<th>User Email</th>
				<th>Action</th>
			</tr>';
			for ($i=0; $i<count($array); $i++) {
				if ($array[$i] != $newway_user_email) {
					echo "<tr class='highlighted'><td>" .$array[$i]."</td>
					<td><button class='delete_user btn btn-danger' id=$array[$i]>Remove</button></td>
					</tr>";
				}
			}
			echo "</table>";

		}
	}
}


if (isset($_POST['user_email'])) {
	if (!empty($_POST['user_email'])) {
		$key = $_POST['user_email'];
		if ($newway_user_email != $key && $newway_user_is_admin && $newway_is_default_login_system) {

				$jsonHandler = new jsonHandler("../../users.json");
				$jsonHandler->remove_key($key);
				echo "1";

		}
		else {
			echo "This action cant be made";
			//dont delete
		}
	}
}
?>