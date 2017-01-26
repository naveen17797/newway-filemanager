<?php 

session_start();
$url = $_SERVER['HTTP_REFERER'];

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
<title>rename | newway</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
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
<div class="col-xs-12 col-lg-12 col-md-4 text-left">
<h1>
<i class="fa fa-shield"></i>&nbsp;New Way
</h1>
<br/><br/><br/><br/><br/>
</div>
<div class="col-xs-4 col-lg-4 col-md-2"></div>
<div class="col-xs-4 col-lg-4 col-md-2 text-center" style="border: 1px solid #eee; border-top: none;">

<h1><i class='fa fa-pencil'></i>&nbsp;rename</h1>

<h3>
<br/><br/>
 rename <br/><br/><?php if (isset($_GET['name'])) { echo htmlentities($_GET['name']); } ?><br/><br/>to
 <form action="rename.php" method="POST">
 <br/>

 <?php 

if (isset($_GET['location'])) {
 $location = htmlentities($_GET['location']); echo "<input type='hidden' style='display:none;' value='$location' name='location'>"; }?>

  <?php
  if (isset($_GET['name'])) {
   $oldname = htmlentities($_GET['name']); echo "<input type='hidden' style='display:none;' value='$oldname' name='oldname'>"; }?>

<?php  echo "<input type='hidden' style='display:none;' value='$url' name='redirect'>"; ?>


<input type="text" class="form-control" placeholder="new name" name="rename">
<br/>
<br/>



<input type="submit" class="btn btn-success" value="Rename">

 </form>
</h3>

</div>

<?php 


if (empty($_SESSION['access_key'])) {

	header("location: 404.php");

}

else {

if (isset($_POST['rename']) && isset($_POST['location']) && isset($_POST['oldname'])) {

	if (!empty($_POST['rename']) && !empty($_POST['location']) && !empty($_POST['oldname'])) {	
			
			$location = $_POST['location'];
			$new_name = $_POST['rename'];
			$old_name = $_POST['oldname'];
			$redirect = $_POST['redirect'];
			$old_name = $location.$old_name;
			$new_name = $location.$new_name;

				if(rename($old_name, $new_name)) {
					header("location: $redirect");
				}
					else {
					header("location: chmod.php");
					}

}

if (empty($_POST['rename']) OR empty($_POST['location']) OR empty($_POST['oldname'])) {	

header("location: $re");

}

}



}
?>