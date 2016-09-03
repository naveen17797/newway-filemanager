<?php 
//total hours wasted here - 40

ini_set('display_errors', 1);
session_start();


if (empty($_SESSION['id'])) {

	//authenciation required to generate a session key

include("templates/front.html");
include("lib/class.login.php");


if (isset($_POST['username']) && isset($_POST['password'])) {

if (!empty($_POST['username']) && !empty($_POST['password'])) {


$login = new login($_POST['username'], $_POST['password']);

}

}

}


else {

	//after login this page will appear to user


include ("lib/class.filefunctions.php");
include("templates/filepage1.php");
include("lib/class.delete.php");

$filefunctions = new filefunctions; //the class for viewing folders and files and perform all file 




if (isset($_POST['directory'])) {

	if (!empty($_POST['directory'])) {
		//this function show a list of files
		$directory = $_POST['directory'];
		$_SESSION['dir'] = $directory; 

}

}

else {

	$directory = "../";
}


$filefunctions->viewfile($directory);


include("templates/filepage2.html");

if (isset($_POST['delete'])) {
if (!empty($_POST['delete'])) {

$delete = new delete($_POST['delete']);


}


}


}










?>
