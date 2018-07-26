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
require 'loader.php';
require 'lib/class.json_handler.php';

/***** THESE LINES ARE FOR THE APPLICATION LOGIN SYSTEM ********/
	/*** IF YOU WANT TO HOOK NEWWAY FILE MANAGER WITH YOUR APP LOGIN SYSTEM, PLEASE REMOVE THESE LINES ***/
if (isset($_SESSION['authorized_email'])) {
	if (!empty($_SESSION['authorized_email'])) {
		
	}
	else {
		header("location: login.php");
	}
}
else {
	header("location: login.php");
}

/******************************************************/

/*************** CONFIG DECLARATION *******************/
//if you are using your own login system, please set this parameters manually//

$newway_user_email = $_SESSION['authorized_email'];

$jsonHandler = new jsonHandler("../../users.json");

$user_data = $jsonHandler->get_value_by_key($newway_user_email);

$user_data = json_decode($user_data, true);

$newway_user_is_admin = $user_data['is_admin'];

$newway_user_read_access = $user_data['r'];

$newway_user_create_access = $user_data['c'];

$newway_user_delete_access = $user_data['d'];

/*******************************************************/

$loader = new loader;
$loader->load_css("css", array("bootstrap", "fontawesome", "global"));
$loader->set_template_file("index_toolbar");
$loader->assign("WRITE_ACCESS_BOOL", "");
$loader->output();
?>