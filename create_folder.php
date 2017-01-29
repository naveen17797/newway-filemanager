<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/materialize.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<title>Create a folder | Newway</title>
<div class="col-xs-12 text-center">
<h2><i class="fa fa-shield"></i>&nbsp;Newway</h2>
</div>
<style type="text/css">

@font-face {
	font-family: ubuntu;
	src: url("fonts/ubuntu.ttf");
}
	body {
		background-color: rgba(0,80,178,0.9);
		font-family: ubuntu;
		color: white;
	}
	.panel {
		background: transparent;
	}
</style>
<?php

require_once 'lib/class.ff.php';


$ff = new ff;


if (empty($_SESSION['access_key'])) {

header('Location: jls-login.php');

exit();

}
if (empty($_GET['dir'])) {

$ff->produceNoParameterError();

exit();

}
else {


$location = $_GET['dir'];


$ff->displayFolderCreateForm($location);



}


//folder-form-validation


if (isset($_POST['folder']) && isset($_POST['dir'])) {
	if (!empty($_POST['folder']) && !empty($_POST['dir'])) {


		$folder_name = $_POST['folder'];

		$path = $_POST['dir'];

		if (is_dir($path.$folder_name)) {

			echo "<div><br/><br/><br/><br/><br/><br/></div><div class='col-xs-12 text-center'><h2>Failure</h2><p style='color: white;'>the folder name, you have typed is already in use</p></div>";
		}
		else {
			mkdir($path.$folder_name);
			header("location: view.php?dir=$path&search=$folder_name");
			exit();

		}



	}
}


























?>