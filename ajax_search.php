<?php 

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



if (isset($_POST['location']) && isset($_POST['chars']) && isset($_POST['string'])) {

	if (!empty($_POST['location']) && !empty($_POST['chars']) && !empty($_POST['string'])) {


			$location = $_POST['location'];

			$string = htmlentities($_POST['string']);

			$chars = $_POST['chars'];

			$search = new search;

			$search->searchFile($location, $chars, $string);



	}
}


?>