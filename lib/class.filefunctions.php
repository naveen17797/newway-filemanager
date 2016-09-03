<?php 
class filefunctions {
public function viewfile ($arg1) {

if ($dh = opendir($arg1)) {

while ($file = readdir($dh)) {

$slash = "/";

if (is_dir($arg1.$slash.$file)) {
// it is a directory
include ("templates/dir_icon.php");

	}

else {

//it is a file


include("templates/fileicon.php");


}


}


}

}
}
?>