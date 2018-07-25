<?php 
/**
 * Setup for newway updater
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
//check for file write access
$dirname = pathinfo(__DIR__);
$dirname = $dirname['dirname'];

if(!file_exists("../../users.json")) {

}
else {
	header("location: index.php");
	exit();
}


if (is_writable($dirname)) {
	$write_access_bool = true;
	$write_access_bool_response = "<i class='fa fa-check' style='color:green;'></i>";
	$write_access_button_enabled = "";
	$write_access_failed_message = "";

}
else {
	$write_access_bool = false;
	$write_access_bool_response = "<i class='fa fa-close' style='color:red;'></i>";
	$write_access_button_enabled  = "disabled";
	$write_access_failed_message = "please keep 777 as permissions for your root folder, if you need newway to work properly";

}
$loader = new loader();
$loader->load_css("css", array("bootstrap", "fontawesome", "materialize", "global"));
$loader->set_template_file("setup");
$loader->assign("WRITE_ACCESS_BOOL", $write_access_bool_response);
$loader->assign("WRITE_ACCESS_BUTTON_DISABLED", $write_access_button_enabled);
$loader->assign("WRITE_ACCESS_FAILED_MESSAGE", $write_access_failed_message);
$loader->output();

//Handle signup information
if (isset($_POST)) {
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		if (!file_exists("../../users.json")) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$jsonHandler = new jsonHandler("../../users.json");
			$value = array("password"=>$password, "r"=>"1", "c"=>"1", "d"=>"1", "is_admin"=>"true");
			$value = json_encode($value);

			$jsonHandler->create_key_value($email, $value);
			header("location: index.php");
			exit();
		}
		else {
			header("location: index.php");
			exit();
		}
	}
}

?>