<?php

session_start();

require 'header.php';

if (isset($_SESSION['access_key'])) {


}

else {
    if (empty($_SESSION['access_key'])) {
        header("location: jls-login.php");
    }
}



if (empty($_GET['dir']) OR empty($_GET['path'])) {

exit("the application has stopped working due to missing parameters which are accidentally/intentionally deleted by the user");


}




?>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/materialize.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<title><?php echo $newway['confirm_delete_title']; ?></title>
<div class="col-xs-12 text-center">
<h2><i class="fa fa-shield"></i>&nbsp;<?php echo $newway['title'];?></h2>
</div>
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

<div class="col-xs-12 text-center">

<h5><?php echo $newway['confirm_dialog_text']; ?>
<br /><br />
<b class="btn btn-large black">
<?php echo $_GET['dir']; ?>
</b>
</h5>
<br /><br />
<a href=delete.php?dir=<?php echo $_GET['dir']; ?>&path=<?php echo $_GET['path'];?> class="btn btn-large red"><i class="fa fa-trash"></i>&nbsp; <?php echo $newway['yes']; ?></a>
&nbsp;&nbsp;&nbsp;<a href=view.php?dir=<?php echo $_GET['path']; ?> class="btn btn-large green"><i class="fa fa-cross"></i>&nbsp;<?php echo $newway['no']; ?></a>

</div>

