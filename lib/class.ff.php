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





//function to shorten file name
public function shortenName($input) {

if(strlen($input) > 12) {

return $filename = substr($input, 0,10);

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


echo "</a><br/><br/><a href='delete.php?dir=$location$file/' style='font-size: 16px;' class='btn btn-danger'>delete</a></div>";
}

}



public function isFile($location, $file) {


echo "<div class='col-xs-3 file text-left'><a href='$location$file' id='$location$file/'><i class='fa fa-file'></i>&nbsp;&nbsp;";

echo $this->shortenName($file);

echo "</a><br/><br/><p><a href='delete.php?dir=$location$file'  class='btn btn-danger'>delete</a>&nbsp;&nbsp;<a href='$location$file' class='btn btn-success' download>download</a></p></div>";


}

public function deleteFolder ($location) {

rmdir($location);

}


public function deleteFile($location) {

$logic = unlink($location);

if ($logic == false) {
header("location: chmod.php");
}

}

public function delete($location) {

$slash = "/";

if ($opendir = opendir($location)) {

	while ($file = readdir($opendir)) {


if (is_dir($location.$slash.$file) == false) {
$logic = $this->deleteFile($file);
if ($logic == false) {
  header("location: chmod.php");
}
}
$this->deleteFolder($location);
}

}


}




public function viewFile($location) {

if ($opendir = opendir($location)) {

	while ($file = readdir($opendir)) {

$slash = "/"; 

//iteration to print only files

if (is_dir($location.$slash.$file) == false) {

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