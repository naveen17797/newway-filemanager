<?php
session_start();
/**
 * Main page for the application
 *
 *
 * Copyright (C) 2018 Naveen Muthusamy <kmnaveen101@gmail.com>
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0.
 * See the Mozilla Public License for more details.
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @package Newway File Manager
 * @author Naveen Muthusamy <kmnaveen101@gmail.com>
 * @link    https://github.com/naveen17797
 */
require_once 'loader.php';
require_once 'lib/class.json_handler.php';

//check if a admin user is present 
if (!file_exists("../../users.json")) {
	header("location: setup.php");
	exit();

}
$loader = new loader();
$loader->load_css("css", array("bootstrap", "fontawesome", "materialize", "global"));
$loader->set_template_file("login");
$loader->assign("SAMPLE", "");
$loader->output();

if (isset($_POST)) {
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$jsonHandler = new jsonHandler("../../users.json");
		$email_exists = $jsonHandler->check_if_key_exists($email);
		if ($email_exists) {
			//get the password from json
			$values_json = $jsonHandler->get_value_by_key($email);
			$values_array = json_decode($values_json, true);
			$hashed_password = $values_array['password'];
			if (password_verify($password, $hashed_password)) {
				$_SESSION['authorized_email'] = $email;
				header("location: index.php");
				exit();
			}
			else {
				//error message	
				echo "<div class='alert alert-danger'>
				Email or password is incorrect
				</div>";	
			}
		}
		else {
			//error message	
				echo "<div class='alert alert-danger'>
				Email or password is incorrect
				</div>";
		}

	}

}

?>