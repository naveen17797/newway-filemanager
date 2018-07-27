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
require 'lib/class.file_functions.php';

/***** THESE LINES ARE FOR THE APPLICATION LOGIN SYSTEM ********/
	/*** IF YOU WANT TO HOOK NEWWAY FILE MANAGER WITH YOUR APP LOGIN SYSTEM, PLEASE REMOVE THESE LINES ***/
if (isset($_SESSION['authorized_email'])) {
	if (!empty($_SESSION['authorized_email'])) {
		
	}
	else {
		header("location: login.php");
		exit();
	}
}
else {
	header("location: login.php");
	exit();
}

/******************************************************/


$newway_user_email = $_SESSION['authorized_email'];

$jsonHandler = new jsonHandler("../../users.json");

$user_data = $jsonHandler->get_value_by_key($newway_user_email);

$user_data = json_decode($user_data, true);


/*************** CONFIG DECLARATION *******************/
//if you are using your own login system, please set this parameters manually//

/**************PARAMETERS TO BE ASSIGNED MANUALLY**************************/
/**
*@var boolean $newway_user_read_access - determines a user cam read files
*@var boolean $newway_user_create_access - determines whether a user can create files
*@var boolean $newway_user_delete_access - determines a user can delete files
*@var boolean $newway_user_is_admin - whether user is admin, if set to true the user can add other users
**/
$newway_user_is_admin = $user_data['is_admin'];

$newway_user_read_access = $user_data['r'];

$newway_user_create_access = $user_data['c'];

$newway_user_delete_access = $user_data['d'];

$newway_root_directory = "../";

/*******************************************************/








/*******************************************************/

$loader = new loader;
$loader->load_css("css", array("bootstrap", "fontawesome", "global", "izimodal", "index", "izitoast"));
$loader->set_template_file("index_toolbar");
if ($newway_user_create_access) {
	$loader->assign("WRITE_ACCESS_BOOL", "");
}
else {
	$loader->assign("WRITE_ACCESS_BOOL", "disabled");
}

if ($newway_user_delete_access) {
	$loader->assign("DELETE_ACCESS_BOOL", "");
}
else {
	$loader->assign("DELETE_ACCESS_BOOL", "disabled");
}


$loader->output();

/** checking if user has read access**/
if ($newway_user_read_access) {
	
	if (isset($_GET['directory'])) {
		if (!empty($_GET['directory'])) {
			$newway_root_directory = $_GET['directory'];
		}
	}
	if (is_dir($newway_root_directory)) {
		$array_of_files_and_folders = scandir($newway_root_directory);
		echo "<div class='col-lg-12 col-sm-12 col-md-12' style='height: 80%; overflow-y:scroll;'><br/><br/>";
		echo "<table class='table table-striped table-hover table-responsive'>";
		echo "<thead><tr class='heading'><th>File/Folder</th>";
		echo "<th>Size</th>";
		echo "<th>Date Modified</th></tr></thead><tbody>";
		for($i=0; $i<count($array_of_files_and_folders); $i++) {
			if ($array_of_files_and_folders[$i] !="." && $array_of_files_and_folders[$i] != "..") {
				$stat_array = stat($newway_root_directory.$array_of_files_and_folders[$i]);
				$modified_time = $stat_array['mtime'];
				if (is_dir($newway_root_directory.$array_of_files_and_folders[$i])) {
					$ELEMENT_TYPE = "<i class='fa fa-folder'></i>";
					    $bytestotal = 0;
				    $path = realpath($newway_root_directory.$array_of_files_and_folders[$i]);
					    if($path!==false && $path!='' && file_exists($path)){
					        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
					            $bytestotal += $object->getSize();
					        }
					    }
					    $size = $bytestotal;
				}
				else {
					$ELEMENT_TYPE = "<i class='fa fa-file'></i>";
					$size = $stat_array['size'];
				}
				$units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
	    		$power = $size > 0 ? floor(log($size, 1024)) : 0;
	    		$SIZE = number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];


	    		/**CREATE FILE/FOLDER VIEW**/

				$loader->set_template_file("index_single_element");
				$loader->assign("ELEMENT_TYPE", $ELEMENT_TYPE);
				$loader->assign("FULLNAME", $array_of_files_and_folders[$i]);
				$loader->assign("NAME", substr($array_of_files_and_folders[$i], 0,8));
				$loader->assign("DATE_MODIFIED", date("F d, Y h:i A", $modified_time));
				$loader->assign("SIZE", $SIZE);
				$loader->output();
				
			}
		}
		echo "</tbody></table></div>";
	}
	else {
		$loader->set_template_file("error_message");
		$loader->assign("MESSAGE","The directory is not valid");
		$loader->output();
	}
	
}	
else {
	$loader->set_template_file("index_file_view_failed");
	$loader->output();
}
$loader->load_js("js", array("jquery", "izimodal", "index", "izitoast"));
?>