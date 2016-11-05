<TITLE>NEW WAY</TITLE>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<div class="col-xs-12 col-lg-12 col-md-4" id="header">
<h1><a href="index.php" style="text-decoration: none;" id="h"><i class='fa fa-shield'></i>&nbsp;New way</h1>


</div>
<div class="col-xs-12 col-lg-12 col-md-4">
<br/><br/><br/>

</div>

<div id="files" class="col-xs-12 col-lg-12 col-md-4">

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

session_start();

$_SESSION["acess_key"] = "dffvdgvdfgvf";

include 'lib/class.ff.php';


if (empty($_GET['dir'])) {
	header("location: 404.php");
}


if (!empty($_SESSION['acess_key']) && !empty($_GET['dir'])) {

//get the directory location
$dir = $_GET['dir'];
$ff = new ff;
$ff->viewFolder($dir);
$ff->viewFile($dir);
}



?>
</div>
<style type="text/css">
	

#footer {
	background-color: #2165c1;
	height: 150px;
	font-family: ubuntu;
	font-size: 24px;
	color: white;
}

.folder, .file {

cursor: pointer;
	padding: 30px;
	font-family: ubuntu;
	font-size: 20px;


		
		color: white;

		
}

.folder:hover, .file:hover {
color: white;
background-color: rgba(0,0,98,1);

}
.btn {
	font-size: 14px;
}






#options {
	padding-left: 80px;
	padding-right: 80px;
}

#header {

	background-color: #2165c1;
	height: 70px;
	font-family: ubuntu;
	color: white;
}

body {
	background-color: rgba(0,0,103,0.9);
}
th,td {
	
	background-color: #2165c1;
	color: white;
padding: 80px;
padding-bottom: 10px;
padding-top: 10px;
padding-left: 20px;
}
td {

}
table {
	font-family: ubuntu;
	font-size: 30px;
}
tr {
	background-color: transparent;
	color: #2165c1;
}
a {
text-decoration: none;
color: inherit;
	
}
a:hover {

text-decoration: underline;
color: inherit;

}
a:visited {
text-decoration: none;
color: inherit;
}
a:active {
	color: white;
}
#h, #h:visited, #h:active {
	color: white
}

</style>