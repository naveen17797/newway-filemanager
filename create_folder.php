<?php session_start();
require 'header.php';
 ?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/materialize.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<title><?php echo $newway['create_folder_title']; ?></title>
<div class="col-xs-12 text-center">
<h2><i class="fa fa-shield"></i>&nbsp;<?php echo $newway['title']; ?></h2>
</div>
<style type="text/css">

@font-face {
    font-family: ubuntu;
    src: url("fonts/ubuntu.ttf");
}
    body {
        background-color: rgba(0,80,178,0.9);
        font-family: ubuntu;
        color: white;
    }
    .panel {
        background: transparent;
    }
</style>
<?php

require_once 'lib/class.ff.php';


$ff = new ff;


if (empty($_SESSION['access_key'])) {

header('Location: jls-login.php');

exit();

}
if (empty($_GET['dir'])) {

$ff->produceNoParameterError();

exit();

}


$location = $_GET['dir'];


?>
<div class='col-xs-12 text-center'><br /><br /><br /><br />

<br /><br />
<?php echo $newway['enter_folder_name']; ?>
<form method='POST'><input type='text' placeholder=' name of the folder, ie:ABC' style='width: 500px;' name='folder'><input type='hidden' value=<?php echo $location;?> name='dir'><br /><br /><input type='submit' class='btn btn-large blue' <?php echo "value='".$newway['create_folder']."'"; ?>></form>
</div>




<?php
//folder-form-validation


if (isset($_POST['folder']) && isset($_POST['dir'])) {
    if (!empty($_POST['folder']) && !empty($_POST['dir'])) {


        $folder_name = $_POST['folder'];

        $path = $_POST['dir'];

        if (is_dir($path.$folder_name)) {

            echo "<div><br /><br /><br /><br /><br /><br /></div><div class='col-xs-12 text-center'><h2>";echo $newway['failure']; echo "</h2><p style='color: white;'>";echo $newway['folder_failure_message']; echo "</p></div>";
        }
        else {
            mkdir($path.$folder_name);
            $message = "Create Folder Function: the folder $foldername has been created at $path at $date";
            writeLog($message);
            header("location: view.php?dir=$path&search=$folder_name");
            exit();

        }



    }
}


























?>