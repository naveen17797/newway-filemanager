<meta charset="utf-8">
<?php
session_start();
if(empty($_SESSION['access_key'])) {

	header('Location: jls-login.php');
	die();

}
require 'functions.php';
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



class search {


public function searchFile($location, $chars, $string) {

if ($opendir = opendir($location)) {
echo "<br/><br/>";

	while ($file = readdir($opendir)) {

$string = strtolower($string);

     if ($string == strtolower(substr($file, 0,$chars))) {

			if ($this->checkDir($location, $file)) {

				echo "<a href='view.php?dir=$location$file/'><i class='fa fa-folder'></i>&nbsp;&nbsp;", $file;

				echo "</a><br/><br/>";

			}

			else {

				echo "<a href='$location$file' download><i class='fa fa-file'></i>&nbsp;&nbsp;", $file;

				echo "</a><br/><br/>";

			}
     

     }


	}



}



}


public function checkDir($location, $file) {
	$slash = "/";
if (is_dir($location.$slash.$file) == true) {
	return true;
}

else {
	return false;
}

}




}



if (isset($_POST['location']) && isset($_POST['chars']) && isset($_POST['string']) && isset($_POST['key'])) {

	if ($_POST['key'] == $_SESSION['access_key']) {

	if (!empty($_POST['location']) && !empty($_POST['chars']) && !empty($_POST['string']) && !empty($_POST['key'])) {

		




			$location = $_POST['location'];

			$string = htmlentities($_POST['string']);

			$chars = $_POST['chars'];

			$search = new search;

			$search->searchFile($location, $chars, $string);

			$message = "Search function: searched for $string at $date";

			writeLog($message);

		}
		

	}
	else {
			exit("your access_key does not match our key");
		}

}


?>