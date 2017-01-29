<?php
session_start();


if (isset($_SERVER['HTTP_REFERER']))

{

		$url = $_SERVER['HTTP_REFERER'];

}
/**
                            *@package: newway
*
                       *@author: Newway developer community
*
                         *@category: file manager
*
                      *@link http://github.com/naveen17797/newway
*
                      *
                   *#THIS FILE IS AN INTEGRAL COMPONENT OF NEWWAY V.1.0.0.0 VIBRANIUM. IT CAN BE MODIFIED, ALTERED, AND/OR *EDITED AS PER YOUR NEEDS. IT'S FREEWARE AND OPEN-SOURCE SOFTWARE.
*
*
*

*/


//includes the core class for newway
include 'lib/class.ff.php';
$ff = new ff;

if (empty($_SESSION['access_key'])) {

header('Location: jls-login.php');


exit();


}


?>

<title>Upload | Newway</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<style type="text/css">
@font-face {
	font-family: ubuntu;
	src: url("fonts/ubuntu.ttf");
}
body {

	background-color: rgba(0,0,103,0.9);
font-family: ubuntu;
color: white;

}


</style>
<div class="col-xs-12 col-lg-12 col-md-4 text-left">
<h1>
<i class="fa fa-shield"></i>&nbsp;Newway
</h1>
<br/><br/><br/><br/><br/>
</div>

<div class="col-xs-2"></div>
<div class="col-xs-8  col-lg-8 text-center" style="border: 1px solid #eee; border-top: none;">
<h1><i class="fa fa-upload"></i>&nbsp;UPLOAD FILES</h1><hr/>
<br/>
<br/>
	<h2>Destination: &nbsp;&nbsp;&nbsp;<b>
	<?php

	if (isset($_GET['dir']))
{

	  $dir = $_GET['dir'];
}
	  ?>
	  
	  </b></h2>
	<br/><br/>
	<form action="upload.php" enctype="multipart/form-data" method="POST">


<?php

	if (isset($_GET['dir']))
	{

		echo "<input type='hidden' name='location' value=$dir>";


	}

?>


<input type="file" class='btn btn-warning' style="background: transparent; margin-left: 19.5em;" name="file[]" multiple="true">
<br/><br/>
<button type="submit" name="submit" class="btn btn-primary">upload</button>


	</form>
	<br/>
<br/>
</div>

<?php

//uploading file


if (isset($_FILES['file'])) {


   if (!empty($_FILES['file'])) {



   		$redirect_url = $_POST['redirect_url'];


   		$dir = $_POST['location'];





   		for ($i = 0; $i<count($_FILES['file']['name']); $i++) {

   

   		$tmp_name = $_FILES['file']['tmp_name'][$i];

   		$name = $_FILES['file']['name'][$i];

   		$location = $dir.$name;

   		$logic = $ff->uploadFile($tmp_name, $location);

   
   		}

   		if ($logic == false) {

   			header("location: view.php?dir=$dir");

   		}
   


   

   }




}







?>