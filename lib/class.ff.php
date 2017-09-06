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
                      *
                   *#THIS FILE IS AN INTEGRAL COMPONENT OF NEWWAY V.1.0.0.0 VIBRANIUM. IT CAN BE MODIFIED, ALTERED, AND/OR *EDITED AS PER YOUR NEEDS. IT'S FREEWARE AND OPEN-SOURCE SOFTWARE.
*
*
*

*/

class ff {


public function sCheck($input) {

return $input = htmlentities($input);

}



































public function produceNoParameterError() {

echo "<div class='text-center'><br/><br/><h2>invalid operation</h2><br/><br/> you didnt provide enough details to access this page, it may occur if you edit the url of this application, <br/><br/>
<a href='index.php' class='btn btn-large red'>return home</a></div>
";

}




public function uploadFile($tmp_location, $location) {

if (move_uploaded_file($tmp_location, $location)) {

}
else {
  echo "an unexpected error occured while uploading";


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


echo "</a><br/><br/><a href='confirm_delete.php?dir=$location$file&path=$location' style='font-size: 16px;' class='btn btn-danger'><i class='fa fa-trash'></i></a>&nbsp;&nbsp;<a href='rename.php?dir=$location$file&name=$file&location=$location' class='btn btn-info'><i class='fa fa-pencil'></i></a></div>";
}

}



public function isFile($location, $file, $if_ubuntu) {

if (empty($if_ubuntu)) {

$attachment = "";

}
else {

  $attachment = $if_ubuntu;

}



echo "<div class='col-xs-3 file text-left'><a href='$attachment$location$file' id='$location$file/'><i class='fa fa-file'></i>&nbsp;&nbsp;";

echo $this->shortenName($file);

echo "</a><br/><br/><p><a href='confirm_delete.php?dir=$location$file&path=$location'  class='btn btn-danger'><i class='fa fa-trash'></i></a>&nbsp;&nbsp;<a href='rename.php?dir=$location$file&name=$file&location=$location' class='btn btn-info'><i class='fa fa-pencil'></i></a></p></div>";








}

public function deleteFolder ($location) {

rmdir($location);

}


public function deleteFile($location, $url) {

$logic = unlink($location);

if ($logic == false) {
 if (chmod($location, "777")) {
    if (unlink($location)) {
      header("$location: view.php?dir=$url");
    }
    else {
    header("location: view.php?dir=$url");
  }
  }
  else {
    header("location: view.php?dir=$url");
  }

}
elseif($logic == true) {
  //redirect to same page with referrer url
  header("location: view.php?dir=$url");
}

}







public function delete($location, $url) {

$slash = "/";

if ($opendir = opendir($location)) {

	while ($file = readdir($opendir)) {

if ($file != "." && $file!="..") {
if (is_dir($location.$slash.$file) == false) {
unlink($location.$slash.$file);
}
if (is_dir($location.$slash.$file) == true) {
  $loc = $location.$slash.$file;
$this->delete($loc);
}
}

}
//while loop ends before
$logic = rmdir($location);
if ($logic == true) {
header("location: view.php?dir=../");
}
else {
  echo "change the folder permissions";
}

}

}







public function viewFile($location, $if_ubuntu) {

if ($opendir = opendir($location)) {



	while ($file = readdir($opendir)) {

        $slash = "/";

        //iteration to print only files

        if (is_dir($location.$slash.$file) == false)
        {

            $this->isFile($location, $file, $if_ubuntu);


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