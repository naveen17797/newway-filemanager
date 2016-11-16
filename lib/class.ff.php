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
                      *
                   *#THIS FILE IS INTEGRAL COMPONENT OF NEW WAY V.1.0.0.0 VIBRANIUM, THIS CAN BE MODIFIED, ALTERED, OR *EDITED ACCORDING TO YOUR WISH. ITS A FREEWARE AND OPENSOURCE SOFTWARE
*
*
*

*/

class ff {


public function sCheck($input) {

return $input = htmlentities($input);

}




public function uploadFile($tmp_location, $location, $redirect) {

if (move_uploaded_file($tmp_location, $location)) {

header("location: $redirect");

}

}



//function to shorten file name
public function shortenName($input) {

if(strlen($input) > 12) {

$dots = "..";

return $filename = substr($input, 0,10).$dots;

}
else {

	return $filename = $input;
}

}





//function to show files
public function isDir($location, $file) {
if ($file != "." AND $file != "..") {
echo "<div class='col-xs-3 folder text-left'><a href='view.php?dir=$location$file/' id='$location$file/'><i class='fa fa-folder'></i>&nbsp;&nbsp;";
//folder name prints in this

echo $this->shortenName($file);


echo "</a><br/><br/><a href='delete.php?dir=$location$file' style='font-size: 16px;' class='btn btn-danger'><i class='fa fa-trash'></i></a>&nbsp;&nbsp;<a href='rename.php?dir=$location$file&name=$file&location=$location' class='btn btn-info'><i class='fa fa-pencil'></i></a></div>";
}

}



public function isFile($location, $file) {


echo "<div class='col-xs-3 file text-left'><a href='$location$file' id='$location$file/'><i class='fa fa-file'></i>&nbsp;&nbsp;";

echo $this->shortenName($file);

echo "</a><br/><br/><p><a href='delete.php?dir=$location$file'  class='btn btn-danger'><i class='fa fa-trash'></i></a>&nbsp;&nbsp;<a href='rename.php?dir=$location$file&name=$file&location=$location' class='btn btn-info'><i class='fa fa-pencil'></i></a></p></div>";


}

public function deleteFolder ($location) {

rmdir($location);

}


public function deleteFile($location, $url) {

$logic = unlink($location);

if ($logic == false) {
header("location: chmod.php");
}
elseif($logic == true) {
  //redirect to same page with referrer url
  header("location: $url");
}

}

public function delete($location, $url) {

$slash = "/";

if ($opendir = opendir($location)) {

	while ($file = readdir($opendir)) {


if (is_dir($location.$slash.$file) == false) {
$logic = unlink($location.$slash.$file);
}

}
//while loop ends before
$logic = rmdir($location);
if ($logic == true) {
header("location: $url");
}
else {
  header("location: chmod.php");
}
}

}







public function viewFile($location) {

if ($opendir = opendir($location)) {



	while ($file = readdir($opendir)) {

        $slash = "/";

        //iteration to print only files

        if (is_dir($location.$slash.$file) == false)
        {

            $this->isFile($location, $file);


        }


        unset($file);
	}



}



}







public function viewFolder($location) {

//function to view all files
if ($opendir = opendir($location)) {

while ($file = readdir($opendir)) {
$slash = "/";

if (is_dir($location.$slash.$file)) {
	$this->isDir($location, $file);
}

unset($file);


}
}

else {header("location: 404.php");}






}









}













?>