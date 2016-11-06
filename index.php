<?php 
session_start();
if(empty($_SESSION['acess_key'])) {

	header("location: login.php");

}

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
<title>New way File manager</title>
<div class="col-xs-12 col-lg-12 col-md-4" id="header">
<h1><a href="index.php"><i class='fa fa-shield'></i>&nbsp;New way</a>



</div>

<div class="col-xs-12 col-lg-12 col-md-4 text-left">
<br/><br/>

<br/><br/>
</div>



<div class="col-xs-12 col-lg-12 col-md-4 text-center">






<div class="form-group">
<form class="form-inline" action="view.php" method="GET">
<input type="text" name="dir" class="form-control" style="width: 700px; " placeholder="enter the directory" value="../">
<input type="submit" value="browse" class="btn btn-danger">
</form>


</div>
</div>


<div class="col-xs-2"></div><div class="col-xs-8 text-center col-lg-8 col-md-4"><br/><br/><br/><br/><div class="panel panel-primary">
<div class="panel panel-heading"><i class="fa fa-shield"></i>&nbsp;Tips</div>

<div class="panel panel-body">
<li>use ../ if you are going to browse server home directory</li>
<br/>
<br/>
<li>use /home/ if you are going to browse ubuntu home directory<br/><br/>

front and backslash mandatory for ubuntu</li>
<br/>


</div></div>





<style type="text/css">

@font-face {

	font-family: ubuntu;
	src: url("fonts/ubuntu.ttf");
}
	

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

	border: 1px solid #eee;
		
		color: #2165c1;
		border-right: none;
}

.folder:hover, .file:hover {
color: white;
background-color: #2165c1;

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
	background-color: #fff;
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
color: black;
	
}
a:hover {

text-decoration: underline;
color: white;

}
a:visited {
text-decoration: none;
color: white;

}

a:active {
	text-decoration: none;
	color: white;
}
.panel {

	font-family: ubuntu;
	font-size: 20px;
}
</style>

<script type="text/javascript" src="js/jquery.min.js"></script>
