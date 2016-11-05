<?php 


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
	
	body {

		background-color: rgba(134, 0, 0, 0.9);
		color: white;
		font-family: ubuntu;

	}
</style>




<?php 

include 'lib/class.ff.php';


if (empty($_GET['dir']) && empty($_SESSION['acess_key'])) {
//making sue no acess without security key and paramaters
	header("location: 404.php");
}

if (!empty($_GET['dir'])) {

$dir = $_GET['dir'];

$ff = new ff;

$ff->deleteFile($dir);

header('$location: $url');

}















?>