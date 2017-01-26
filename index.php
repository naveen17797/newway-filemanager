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



class parseJson {



public function display($array) {


$filename = "manifest.json";

$json_data = file_get_contents($filename);

$json = json_decode($json_data, true);

echo $json[$array];


}




}


$json = new parseJson;




?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<link rel="stylesheet" type="text/css" href="css/materialize.css">
<title>New way File manager</title>
<div class="col-xs-12 col-lg-12 col-md-4 navbar navbar-fixed-top" id="header">
<h4><a href="index.php"><i class='fa fa-shield'></i>&nbsp;New way</a>

<a href="docs/" class="btn btn-large blue" style="margin-left: 56em; width: 20%;">Documentation</a>
</h4>

</div>

<div class="col-xs-12 col-lg-12 col-md-4 text-left">
<br/><br/>

<br/><br/>
</div>



<div class="col-xs-12 col-lg-12 col-md-4 text-center">

<br/><br/>

<br/><br/><br/><br/>

<br/><br/>




<div class="form-group">
<form class="form-inline" action="view.php" method="GET">
<input type="text" name="dir" class="form-control" style="width: 700px; " placeholder="enter the directory" value="../">&nbsp;&nbsp;
<input type="submit" value="browse" class="btn btn-danger">
</form>
</div>

<br/><br/>



<div class="col-xs-4  col-lg-4 col-md-4">
<div class="btn btn-large pink" style=" margin-top: 0px; padding-bottom: none;"><i class="fa fa-shield"></i>&nbsp;Tips</div>

<div id="contents">
<br/>
<li>use ../ if you are going to browse server home directory</li>

<li>use /home/ if you are going to browse ubuntu home directory

front and double slash is mandatory for <b>ubuntu</b> as well as <b>server</b></li>


<br/>


</div>
</div>

<div class="col-xs-4">
<div class="btn btn-large green" style="">
<i class="fa fa-tree"></i>&nbsp;&nbsp;Whats new?</div>
<div id="contents">
<br/>
<li><b style="color: rgba(0,0,0,1);"> bug</b> in using for ubuntu has been fixed</li>
<li>fixed <b>renaming</b> bug in old version</li>
<li>secure <b>authenciation</b> method added to protect your files, folders in your server</li>
</div>
</div>







<div class="col-xs-4">
<div class="btn btn-large black" style="">
<i class="fa fa-floppy-o"></i>&nbsp;&nbsp;version information</div>
<div id="contents">
<br/>
<li>author info:   &nbsp;&nbsp;<b><?php $json->display("author name"); ?></b></li>
<li>version:&nbsp;&nbsp; <b><?php $json->display("version"); ?></b></li>
<li>version name: &nbsp;&nbsp;<b><?php $json->display("codename"); ?></b></li>
<li>Licensed Under&nbsp;&nbsp;<b><?php $json->display("license"); ?></b></li>
<li>updated on&nbsp;&nbsp; <b><?php $json->display("released"); ?></b></li>
<li>estimated date for next update&nbsp;&nbsp;<b><?php $json->display("ETU"); ?></b></li>
</div>
</div>









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
.blue {
	margin-bottom: 0px;
	padding-bottom: 0px;
}

#header {

	background-color: rgba(0,0,0,0.8);
	font-family: ubuntu;
	color: white;
	
	padding-bottom: 0px;
	margin-bottom: 0px;
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
#contents {

height: 280px;
font-family: ubuntu;
background-color: #eee;
line-height: 2.5em;
font-style: bold;


}

.pink, .green, .black  {
width: 100%;
text-transform: capitalize;
font-family: ubuntu;

}
b{
	color: rgba(0,0,0,1);
}
#updates {
	display: none;
	font-family: ubuntu;
}
</style>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {

		$('#updates').fadeIn("slow");

	});
</script>