

<?php 





//deleting file
class deletefile {

	public function __construct($dest) {
		$this->delete($dest);

	}
	public function delete ($dest) {


unlink("$dest");
header("location: index.php");
		
	}



}






/* class for listing files*/

class file {
	public function __construct($dir) {
$this->file($dir);

	}

public function file($dir) {

if ($dh = opendir($dir)) {

while ($file = readdir($dh)) {
	 $ext = pathinfo($file, PATHINFO_EXTENSION);


	 if (empty($ext)) {

echo "<h5><i class='fa fa-folder'></i>&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<a href='$dir/$file' download>";
echo $file, '</a></h5>';






	 }

elseif ($ext == 'pdf') {
		echo "<div id='plate'>";

	echo "<h5><i class='fa fa-file-pdf-o'></i>&nbsp;&nbsp;&nbsp;&nbsp;";


echo $file, '</a>';

echo "<form method='POST' action='index.php'><input type='hidden' name='file' value='$dir$file'><input type='submit' value='delete' class='submit'>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href='$dir$file' class='btn btn-success'><i class='fa fa-eye'>&nbsp;</i>view</a>




<a href='$dir/$file' download>







</form></h5><br/>

</div>";

	
}
else {
	echo "<div id='plate'>";

echo "<h5><i class='fa fa-file-o'></i>&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<a href='$dir/$file' download>";
echo $file, '</a>';


echo "<form method='POST' action='index.php'><input type='hidden' name='file' value='$dir$file'><br/><i class='fa fa-remove'></i><input type='submit' value='delete' class='submit btn btn-danger'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='$dir$file' class='btn btn-success'><i class='fa fa-eye'></i>&nbsp;view</a></form></h5><br/>";

echo "</div>";
}



//loop ends before
}




}




}



}
















?>










<?php




if (empty($_SESSION['name'])) {

	/*


display login page ...










	*/

	echo '<!--header-->
<link rel="stylesheet" href="src/css/bootstrap.css">
<link rel="stylesheet" href="src/css/font.css">
<!--end-->
<style>
	.fa-shekel {
		font-size: 90px;
	}
	body {
		background-color: #eee;
	}
	.submit {
		background-color: black;
		opacity: 0.8;
		padding:10px;
		color: white;
		border: 4px solid #eee;
		border-radius: 60px;

	}
	.submit:active {

	background-color: black;
		opacity: 0.8;
		padding:10px;
		color: white;
		border: 4px solid #eee;
		border-radius: 60px;



	}
	h1 {
		font-family: monospace;
		font-size: 30px;
	}
	a {

	}

</style>
<div class="col-sm-4">
</div>
<div class="col-sm-4 text-center bor">
<br/><br/><br/><br/><br/><br/><br/>
<i class="fa fa-shekel"></i>
<h1>file manager</h1>
<br/>
<form method="POST" action="index.php">
<input type="text" class="form-control" placeholder="username" name="username"><br/>
<input type="password" class="form-control" placeholder="password" name="password">
<br/>
<input type="submit" class="submit btn btn-default" value="login">
<br/><br/>
<a href="#">forget password?</a>
</div>
<div class="col-sm-4">
</div>
';


}
else {


	/*display the list of folders and files in the diectory */

	echo '<!--header-->
<link rel="stylesheet" href="src/css/bootstrap.css">
<link rel="stylesheet" href="src/css/font.css">

<!--end-->
<style>
body {
	background-color: #eee;

}
.fa-folder {
	color: #3399ff;
}
.box {

	height: 400px;
	
	overflow-y: scroll;
	margin-bottom: 10px;

}
hr {
  border-top: 1px solid #fff;
}
.fa-shekel {
font-size: 90px;
}
#plate {
	background-color: #339944;
color: white;
}
a{
	color: white;
}
a:hover {
	color: white;
}
.box {
	background-color: black;
}
#plate:hover {

	opacity: 0.9;
	height: 115px;
	width: 360px;
}
</style>
<div class="col-sm-12 box">


';





$dir = "C://";
$file = new file($dir);



echo "</div>";


}

?>






<?php 
##################delete files
if (!empty($_POST['file'])) {

$dest = $_POST['file'];

$delete = new deletefile($dest);




}








?>



<?php 
//verify user name and password
if (!empty($_POST['username'] && !empty($_POST['password']))) {

$username = "admin";
$password = "admin";


if ($username == htmlentities($_POST['username']) && $password == htmlentities($_POST['password'])) {

session_start();
$_SESSION['name'] = str_shuffle("dfewkeoeritioeuabcdefgeforeirpoeiritrepotifeorjfeiojrfoejfoiefikwfkw;kweqjdpowkfakdapodkopfkofjwpfowpefopwekfoewpjfwihfwopwoipwirwpoeipwoekwpoewpoirrpwkfdpowkepfkeoifierfierweporopwe");


}




}
else {



}


?>