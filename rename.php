<?php
session_start();

$url = $_GET['location'];

require 'header.php';

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




?>
<title><?php echo $newway['rename_title']; ?></title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<style type="text/css">
@font-face {
    font-family: ubuntu;
    src: url("fonts/ubuntu.ttf");
}
body {
    background-color: rgba(0, 80, 178, 0.9);
    font-family: ubuntu;
    color: white;
}
.panel {
    background: transparent;
}
</style>
<div class="col-xs-12 col-lg-12 col-md-4 text-left">
<h1>
<i class="fa fa-shield"></i>&nbsp;<?php echo $newway['title']; ?>
</h1>
<br /><br /><br /><br /><br />
</div>
<div class="col-xs-4 col-lg-4 col-md-2"></div>
<div class="col-xs-4 col-lg-4 col-md-2 text-center" style="border: 1px solid #eee; border-top: none;">

<h1><i class='fa fa-pencil'></i>&nbsp;<?php echo $newway['rename']; ?></h1>

<h3>
<br /><br />
 <?php echo $newway['rename_text']; ?> <br /><br /><?php if (isset($_GET['name'])) { echo htmlentities($_GET['name']); } ?><br /><br /><?php echo $newway['to']; ?>
 <form action="rename.php" method="POST">
 <br />

 <?php

if (isset($_GET['location'])) {
 $location = htmlentities($_GET['location']); echo "<input type='hidden' style='display:none;' value='$location' name='location'>"; }?>

  <?php
  if (isset($_GET['name'])) {
   $oldname = htmlentities($_GET['name']); echo "<input type='hidden' style='display:none;' value='$oldname' name='oldname'>"; }?>

<?php  echo "<input type='hidden' style='display:none;' value='$url' name='redirect'>"; ?>


<input type="text" class="form-control" <?php echo "placeholder='".$newway['rename_placeholder']."'"; ?> name="rename">
<br />
<br />



<input type="submit" class="btn btn-success" value=<?php echo $newway['rename_button_text']; ?>>

 </form>
</h3>

</div>

<?php


if (empty($_SESSION['access_key'])) {
    header("location: 404.php");
}

else {

if (isset($_POST['rename']) && isset($_POST['location']) && isset($_POST['oldname'])) {

    if (!empty($_POST['rename']) && !empty($_POST['location']) && !empty($_POST['oldname'])) {

            $location = $_POST['location'];
            $new_name = $_POST['rename'];
            $old_name = $_POST['oldname'];
            $redirect = $_POST['redirect'];
            $old_name = $location.$old_name;
            $new_name = $location.$new_name;

                if(rename($old_name, $new_name)) {

                    header("location: view.php?dir=$redirect");
                    $date = date("d-m-Y h:i:s");
                    $message = "Rename function: the file $old_name has been renamed to $new_name at $date";
                    writeLog($message);
                }
                    else {
                    header("location: chmod.php");
                    }

}

if (empty($_POST['rename']) OR empty($_POST['location']) OR empty($_POST['oldname'])) {

header("location: $re");

}

}



}
?>