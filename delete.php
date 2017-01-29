<?php
session_start();

/**
                            *@package: newway
*
                       *@author: Newway developer community
*
                         *@category: file manager
*
                      *@link http://github.com/naveen17797/newway
*
                   *#THIS FILE IS AN INTEGRAL COMPONENT OF NEWWAY V.1.0.0.0 VIBRANIUM. IT CAN BE MODIFIED, ALTERED, AND/OR *EDITED AS PER YOUR NEEDS. IT'S FREEWARE AND OPEN-SOURCE SOFTWARE.
*
*
*

*/


?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="css/font.css">

<div class="col-xs-12 col-md-4 col-lg-12 text-center">
<h1><i class="fa fa-shield"></i>&nbsp;&nbsp;NEWWAY</h1>
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



$dir = $_GET['dir'];


if (is_file($dir) == true) {
$ff = new ff;
$ff->deleteFile($dir, $url);
}
//if it is a directory then delete entire directory
elseif(is_dir($dir) == true) {
$ff = new ff;
$ff->delete($dir, $dir);
}



}















?>