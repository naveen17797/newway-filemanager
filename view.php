<title>View | Newway</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<div class="col-xs-12 col-lg-12 col-md-4" id="header">
<div class="form-group">
<form action="view.php" method="GET" class="form-inline">
<h2><a href="index.php" style="text-decoration: none;" id="h"><i class='fa fa-shield'></i>&nbsp;Newway
</a>&nbsp;
<?php

if(isset($_SERVER['HTTP_REFERER'])) {

$http = $_SERVER['HTTP_REFERER'];

}

?>
<style type="text/css">

</style>
<select type='text' name='dir'  class="form-control" style='margin-left: 2em; width: 400px; font-family: ubuntu; font-size:13px; background: transparent; color: white' placeholder="enter any directory to go" id="search_query">
<option value="../">server home</option>

<option value="/home/">ubuntu home</option>

</select>
&nbsp;

<button type="submit" class="btn btn-info" style='background: transparent;'><i class="fa fa-search"></i>&nbsp;browse</button>
<?php $diro = $_GET['dir']; echo "<a href=upload.php?dir=$diro class='btn btn-info' style=' margin-left: 2em; background: transparent;'><i class='fa fa-upload'></i>&nbsp;upload files</a>&nbsp;&nbsp;<a href=create_folder.php?dir=$diro class='btn btn-info' style=' margin-left: 2em; background: transparent;'><i class='fa fa-folder'></i>&nbsp;&nbsp;create folder</a>";?>

</form>

</h2>

</div>
</div>


</div>
<div class="col-xs-12">
<br/>
</div>

<div class="col-xs-3 text-center" id="searchbar">
<h3><i class="fa fa-search"></i>&nbsp;&nbsp;<b>search</b></h3>
		<br/><br/>
			<div class="form-group">
				<div class="form-inline">
					<input type="text" name="search" class="form-control" style="width: 230px" placeholder="search files or folders in this directory" id="string" <?php
					if (!empty($_GET['search'])) {
						$search = $_GET['search'];
						echo "value=$search";

					}
					else {
						echo "value=";
					}

						?>  >
					&nbsp;<button type="submit" id="search" style="height: 35px;" class="btn btn-primary"><i class="fa fa-search"></i></button>
	<br/><br/>
<div id="query" style=" height: 300px;">


					<div id="search_feed" class="text-left" style="font-family: ubuntu; font-size: 14px; height: 100px;">
					</div>

				</div>
			</div>
</div>




</div>
<div class="col-xs-9" id="newway_files">
<br/><br/><br/>
<br/>
<?php

/**
                            *@package: newway
*
                       *@author: Newway developer community
*
                         *@category: file manager
*
                      *@link http://github.com/naveen17797/newway
*
                   *#THIS FILE IS AN INTEGRAL COMPONENT OF NEWWAY V.1.0.0.0 VIBRANIUM. IT CAN BE MODIFIED, ALTERED, AND/OR *EDITED AS PER YOUR NEEDS. IT'S FREEWARE AND OPEN-SOURCE SOFTWARE.
*
*
*

*/

session_start();



include 'lib/class.ff.php';


if (empty($_GET['dir'])) {
	header("location: 404.php");
	exit();
}


if (!empty($_SESSION['access_key']) && !empty($_GET['dir'])) {

//get the directory location
$dir = htmlentities($_GET['dir']);

if (substr($dir, 0,6) == "/home/") {

$if_ubuntu = "file://";


}
else {
	$if_ubuntu = "";
}






$ff = new ff;

$ff->viewFolder($dir);

$ff->viewFile($dir, $if_ubuntu);
}
elseif(empty($_SESSION['access_key'])) {
	header('Location: jls-login.php');
}




?>
</div>


<style type="text/css">

	#searchbar {
		color: white;
		font-family: ubuntu;
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
	font-size: 16px;



		color: white;

}

@font-face {

	font-family: ubuntu;
	src: url("fonts/ubuntu.ttf");
}
.folder:hover, .file:hover {
color: white;
opacity: 1;

}
.btn {
	font-size: 14px;
}






#options {
	padding-left: 80px;
	padding-right: 80px;
}

#header {

background-color: rgba(0,0,0,1);
	height: 70px;
	font-family: ubuntu;
	color: white;
}

body {
	background-color: rgba(30,30,30,1);
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

text-decoration: none;
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

	<script type="text/javascript" src="js/jquery.min.js"></script>


		<script type="text/javascript">

				$(document).ready(function () {


					$('#newway_files').animate({

						bottom: '10px',

						opacity: '1',





					});



				});





$(document).ready(function () {

var string = $('#string').val();

var chars  = string.length;

var location = "<?php echo $_GET['dir']; ?>";

$.post("ajax_search.php", {location: location, chars: chars, string: string}, function (data) {

$('#search_feed').html(data).animate({bottom: '10px',});


});



});

$('#string').keyup(function () {

var string = $('#string').val();

var chars  = string.length;

var location = "<?php echo $_GET['dir']; ?>";

$.post("ajax_search.php", {location: location, chars: chars, string: string}, function (data) {

$('#search_feed').html(data).animate({bottom: '10px',});


});



});






		</script>