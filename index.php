

<?php 
ini_set('display_errors', 1);
session_start();
/*  newway v0.0.3 THORIUM | developed by naveen kingmaker | open source project | licensed under: open GPL(general public usage) license
*/

#######################################login details######################3333333
##############################must change after downloading thi script######

$username = "admin"; //change to your desired wish

$password = "admin"; //change to your wish

#these login credentials must be entered while you are acessing your website


###############################################################################3










class file {


public function __construct() {



}
public function upload($name, $tmp_name, $location) {






move_uploaded_file($tmp_name, $location.$name);

header('location: $location');



}

public function deletefile($arg1) {


unlink($arg1);






}
public function viewfile($arg1) {


if ($dh = opendir($arg1)) {

while ($file = readdir($dh)) {

$slash = "/";

if (is_dir($arg1.$slash.$file)) {


//directory
echo "<div>
<form action='index.php' method='POST'>
<input type='hidden' value='$arg1$file$slash' name='dir'>
<h4><i class='fa fa-folder'></i>
&nbsp;&nbsp;<input type='submit'  value='$file' id='folder'>
<div class='text-right'>
<input type='hidden' value='$arg1$file' name='del'>
<button type='submit'>
<i class='fa fa-trash-o'></i></button>

</div>
</form>
</div>"; 

echo "</h4><hr/><br/>";

}

else {
//file
echo "
<h4>
<i class='fa fa-file'>
</i>&nbsp;&nbsp;<a href='$arg1$file'>
$file</a>
<form action='index.php' method='POST'>
<div class='text-right'>
<input type='hidden' value='$arg1$file' name='del'>
<button type='submit' class='l'>
<i class='fa fa-trash-o'>
</i>
</button>
<a class='l' href='$arg1$file' download>
<i class='fa fa-download'></i>
</a>
</div>
</form>
</h4>"; 



echo "</h1><hr/><br/>";



}














}
}


}
public function deldir($arg1) {

if ($dh = opendir($arg1)) {

	while ($file = readdir($dh)) { 

unlink($file);


	}



}

}





}



?>


<?php 


if (empty($_SESSION['uq'])) {




echo '


<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<title>Newway | the best filemanager </title>

<div class="col-sm-4 co text-center">
<i class="fa fa-shield" alt="my hobby project"></i>
<h1> welcome to <b>Newway</b></h1>


<div class="form-group">
<form action="index.php" method="POST">
<br/>
<label>

<input type="text" name="username" placeholder="username" class="form-control fftc" style="width: 290px;" maxlength="18">
<br/>
<input type="password" name="password" placeholder="password" class="form-control" style="width: 290px;">

<div id="feedback"></div>


<button type="submit" value = "" class="submitbutton">
<i class="fa fa-sign-in"></i></button>
</label>
</form>
</div>
<br/>
<br/>
<br/>
<br/>
</div>




<div class="col-sm-8 addbar text-center">

<h1>Newway -a file explorer</h1>

<div class="l1">
<br/>

easy way to explore your sites, with this new file manager

</div>






<div class="text-left">
<div class="l2">
<br/>
<br/>
<h1>
<i class="fa fa-check"></i>&nbsp;
a simple one file, file manager which almost does everything
</u1>







<div class="l3">
<br/>

<h1>
<i class="fa fa-check"></i>&nbsp;
light weight, scalable, faster

</h1>



</div>



<div class="l4">
<br/>

<h1>
<i class="fa fa-check"></i>&nbsp;
open source project, made better by many developers
</h1>



</div>


<div class="l5">
<br/>

<h1>
<i class="fa fa-check"></i>&nbsp;
secure file managing system , made by php
</h1>



</div>

<div class="text-center">

<div class="l5">
<br/>
<br/>
<br/>
<br/>


<style>
	.fa-github {
		font-size: 40px;
	}
	a:hover {
		color: white;

	}
</style>
<h1><i class="fa fa-github"></i><br/>
<br/>
you can contribute to new way <a href="http://github.com/naveen17797/newway">here</a>


<br/>
<br/>
contributions help to grow us better</h1>





</div>
</div>




















</div>

</h1>
</div>
</div>
</div>

<style type="text/css">
.folder {
	border: none;
	background-color: transparent;
}
a {
	color: white;
}
li {
	font-family: fantasy;
}
.l1, .l2, .l3, .l4, .l5, .l6, .l7, .l8{
	display: none;
	font-family: sans-serif;




	}
	h1 {
		font-size: 20px;
	}
	.addbar {


height: 800px;
background-color: #d26456;
color: white;
font-family: monospace;
display: none;



}
.tt {
	background-color: transparent;
}
.yes {
	background-color: transparent;	
	height: 60px;
	border: 2px solid #fff;
	width: 300px;
}
.no {
	background-color: transparent;	
	height: 60px;
	border: 2px solid #fff;
	width: 300px;
}
.fa-shield {
	font-size: 400px;
	color: #d26456;


}



</style>';


}




elseif ($_SESSION['uq'] == "kwefheikhfiehfieuhtgirhgiuhriguhdighiuhgueihguiehgieuhgeiuhfgieuhfuiehtfiuehgiuehdguihdiughiuthgtiuhtur843t9854t894t9854yt8g7589yt756754t89g5498tg89tg489eyt4e9ytu498tu489eut894eut5894eut94uet98u4t89u4e9t8u54et8u48tu98tu4ut98u4ut9t54ue9tu9ut9t84") {








#######################################after login #####################################################3

if (!empty($_POST['dir'])) {


$x = $_POST['dir'];

$_SESSION['loc'] = $x;


}

else {

$x  = "/var/www/html/";

}
if (empty($_POST['dir']) && !empty($_POST['del'])) {

	$del = $_POST['del'];
	//executes a  delete action on incoming directory

	$det = new file;
	$det->deletefile($del);

}







echo '
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<title>Newway | the best filemanager </title>

';
echo '<div class="jumbotron"><h3><i class="fa fa-shield"></i>&nbsp;new way <i class="fa fa-user" id="admin"></i>&nbsp;admin</h3></div>';

echo '

<div class="col-sm-12  color1 text-center">

<h4>current directory: ', $x, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/></h4><form action="index.php" method="POST" enctype="multipart/form-data"><input type="file" name="file" class="sudo"><br/><br/>
<input type="submit"  value="upload" class="upload"></form>





<div class="col-sm-10 color2 text-left">


';

$file = new file;
$file->viewfile($x);

echo '
</div>
</div>








';

















echo "<style>
.sudo {

	margin-left: 40%;
}

.upload {


	color: black;
}

.color1 {
	background-color: #d26456;
	height: 8x00px;
	display: none;
	color: white;
	font-family: fantasy;
}
.color2 {
		background-color: #fff;
	height: 550px;
	margin-top: 3em;

	margin-bottom: 7em;
		margin-right: 7em;

	margin-left: 7em;
	display: none;
	overflow-y: scroll;
	color: black;
	
}
#admin {
	
	margin-left: 43em;
}

.fa-trash-o {
	color: red;
}


.jumbotron {

	background-color: #d26456;
	color: white;
	padding: 5px;
	margin-bottom: 0px;
}
.fa-shield {
	color: white;


}
#folder {
	background-color: transparent;
	border: none;
}

a {
	color: black;
	text-decoration: none;
}

a:hover {
	color: black;
	text-decoration: none;
}
#fileip {
	
	margin-left: 32em;
	font-size: 15px;



}

</style>




"
;

echo '<script type="text/javascript">
	$(document).ready(function () {
		var z = 700;
		$(".color1").fadeIn(z, function () {
			$(".color2").fadeIn(z);
		});
		
	});
</script>
';


if (!empty($_FILES['file'])) {

$name = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];
$location = $_SESSION['loc'];

$upload = new file;
$upload->upload($name, $tmp_name, $location);

}







}

















##########################################################################################################################3########################################################################################################3




?>



<script>



	
$(document).ready(
			function king () {
		
var z = 800;

$('.co').fadeIn(z).animate({Right: '250px'}, function () {
	$('.addbar').fadeIn(z).animate({Left: '250px'}, function() {
		$('.l1').fadeIn(z, function() {
			$('.l2').fadeIn(z, function() {
				$('.l3').fadeIn(z, function () {
$('.l4').fadeIn(z, function() {

	$('.l5').fadeIn(z, function() {
		$('.l6').fadeIn(z);





	});
});



				});
			});

		});
	});
});


}





);







</script>


<?php 

if (!empty($_POST['username']) && !empty($_POST['password'])) {

if ($_POST['username'] == $username && $_POST['password'] == $password) {


$_SESSION['uq'] = "kwefheikhfiehfieuhtgirhgiuhriguhdighiuhgueihguiehgieuhgeiuhfgieuhfuiehtfiuehgiuehdguihdiughiuthgtiuhtur843t9854t894t9854yt8g7589yt756754t89g5498tg89tg489eyt4e9ytu498tu489eut894eut5894eut94uet98u4t89u4e9t8u54et8u48tu98tu4ut98u4ut9t54ue9tu9ut9t84";
header("location: index.php");

}






}







######################################################################################################









?>


