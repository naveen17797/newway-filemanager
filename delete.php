<?php 
session_start();

/**
                            *@package: newway
*
                       *@author: New way developer community
*
                         *@category: file manager
*
                      *@link http://github.com/naveen17797/newway
*
                   *#THIS FILE IS INTEGRAL COMPONENT OF NEW WAY V.1.0.0.0 VIBRANIUM, THIS CAN BE MODIFIED, ALTERED, OR *EDITED ACCORDING TO YOUR WISH. ITS A FREEWARE AND OPENSOURCE SOFTWARE
*
*
*

*/


?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="css/font.css">

<div class="col-xs-12 col-md-4 col-lg-12 text-center">
<h1><i class="fa fa-shield"></i>&nbsp;&nbsp;NEW WAY</h1>
</div>
<style>
@font-face {

	font-family: ubuntu;
	src: url("fonts/ubuntu.ttf");
}
	
	body {

		background-color: rgba(134, 0, 0, 0.9);
		color: white;
		font-family: ubuntu;

	}
</style>




<?php 

include 'lib/class.ff.php';


if (empty($_GET['dir']) && empty($_SESSION['access_key'])) {
//making sue no acess without security key and paramaters
	header("location: 404.php");
}

if (!empty($_GET['dir']) && !empty($_SESSION['access_key'])) {

$url = $_SERVER['HTTP_REFERER'];

$dir = $_GET['dir'];


if (is_dir($dir) == false) {
$ff = new ff;
$ff->deleteFile($dir, $url);
}
//if it is a directory then delete entire directory
elseif(is_dir($dir) == true) {
$ff = new ff;
$ff->delete($dir, $url);
}



}















?>