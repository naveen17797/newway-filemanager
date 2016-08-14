   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/path/to/jquery.mCustomScrollbar.concat.min.js"></script>
<?php 

session_start();



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

echo "<form action='index.php' method='POST'><i class='fa fa-folder'></i>&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<input type='hidden' value='$dir$file/' name='dir'><input type='submit' value='$file' class='btn btn-link'></form>";




	 }

else {


echo "<i class='fa fa-file-o'></i>&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<a href='$dir/$file' download>";
echo $file, '</a>';


echo "<div id='proxy'><form method='POST' action='index.php'><input type='hidden' name='file' value='$dir$file'><i class='fa fa-remove'></i><input type='submit' value='delete' class='submit btn btn-danger'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='$dir$file' class='btn btn-success'><i class='fa fa-eye'></i>&nbsp;view</a></form></div><br/><br/>";

}



//if else loop ends before
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
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
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
</form>
<br/><br/>
<a href="#">forget password?</a>
</div>
<div class="col-sm-4">
</div>
';


}
else {
if (!empty($_POST['dir'])) {
	$dir = $_POST['dir'];

}
else {
$dir = "../";
}

	/*display the list of folders and files in the diectory */

	echo '<!--header-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

<!--end-->
<style>

.fa-folder {
	color: #3399ff;
}
.box {

	height: 790px;
	
	overflow-y: scroll;
	margin-bottom: 10px;
		background-color: black;
		font-size: 40px;
	

}
.col-sm-3 {
height: 790px;
background-color: black;
color: #3399ff;
	

}
hr {
  border-top: 1px solid #fff;
}
.fa-shekel {
font-size: 90px;
}
#plate {
padding: 0px;
	background-color: #339944;
	display: none;
color: white;
}
a{
	color: white;
}
a:hover {
	color: white;
}

#plate:hover {

	opacity: 0.9;
	dispay: block;

}
	.fa-file-o {



		color: #3399ff;
	}

#proxy {
			display: inline-block;
			margin-left: 4em;
	}
	.fa-shekel {


		color: #3399ff;
		font-size: 80px;
	}
	B {
		color: #3399ff;
	}
	.fa-folder-open {
		color: #3399ff;
	}
	#form {
	font-size: 15px;
	color: #3399ff;
}


</style>
<div class="col-sm-9 box scrollbar" id="style-1">
<h1 align="center"><i class="fa fa-shekel"></i><br/><BR/><b>FILE MANAGER</B></h1>
<br/>
<br/><div id="form"><form action="index.php" method="POST" class="form-group"><input type="text" name="dir" placeholder="c:// or any directory"><input type="submit" value="open the direcotry"></form></div>';
echo '<b><i class="fa fa-folder-open"></i>&nbsp;&nbsp;', $dir, '</b><br/><br/>';



$file = new file($dir);




echo "</div>";
echo '<div class="col-sm-3 text-center scrollbar sd" id="style-1">

<h1 align="center"><i class="fa fa-shekel"></i></h1>
<h1 align="center"><b>instructions</b></h1>
<br/>
<br/>
<li>use delete option to delete files,the files wont be recovered after deleting</li>

<br/>
<br/>
<li>cick to download the file,easy to download files.click on the file, you see.you will get downloaded.</li>



<br/>
<br/>
<li>click to view the file in your browser.the file will be opened in the window</li>


<br/>
<br/>
<li>more features coming soon......</li>













</div>';


}

?>












<!--delete fie-->

<?php 
##################delete files
if (!empty($_POST['file'])) {

$dest = $_POST['file'];

$delete = new deletefile($dest);




}








?>








<!--password verification-->

<?php 
//verify user name and password
if (!empty($_POST['username']) && !empty($_POST['password'])) {





//change username and password according to your wish ############################33
                           $username = "admin";                            #########################
                           $password = "admin";                             ########################
############################################################################

if ($username == htmlentities($_POST['username']) && $password == htmlentities($_POST['password'])) {

$_SESSION['name'] = str_shuffle("dfewkeoeritioeuabcdefgeforeirpoeiritrepotifeorjfeiojrfoejfoiefikwfkw;kweqjdpowkfakdapodkopfkofjwpfowpefopwekfoewpjfwihfwopwoipwirwpoeipwoekwpoewpoirrpwkfdpowkepfkeoifierfierweporopwe");

header("location: index.php");


}




}
else {


}


?>

<style>
	 *  STYLE 1
 */

#style-1::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar
{
	width: 12px;
	background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar-thumb
{
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
}




</style>