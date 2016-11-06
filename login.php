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


if (isset($_POST['username']) && isset($_POST['password'])) {
if (!empty($_POST['username']) && !empty($_POST['password'])) {
$username = $_POST['username'];
$password = $_POST['password'];
if ($username == "admin" && $password == "admin") {
	$_SESSION['acess_key'] = password_hash("abcdefghijklmnopqrstuvwxyz", PASSWORD_DEFAULT);
header("location: index.php");

}


}
}

?>
<title>login | ubuntu</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<style type="text/css">
@font-face {

	font-family: ubuntu;
	src: url("fonts/ubuntu.ttf");
}
	body {
		background-color: rgba(0,0,103,0.9);
		color: white;
		font-family: ubuntu;
	}
</style>
<div class="col-xs-12"><br/>
<br/>
<br/></div>
<div class="col-xs-4 col-lg-4 col-md-1"></div>
<div class="col-xs-4 col-lg-4 col-md-4 text-center" style="border: 1px solid #eee; border-top: none;">

<i class="fa fa-shield" style="font-size: 300px;"></i>
<br/>
<br/>
<h3>Login</h3>
<br/>
<form action="login.php" method="POST">
<input type="text" class="form-control" name="username" placeholder="username">
<br/><br/>
<input type="password" class="form-control" name="password" placeholder="password">
<br/>
<br/>
<input type="submit" value="login" class="btn btn-primary"></form>
<br/>

</div>