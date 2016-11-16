<?php
session_start();
$url = $_SERVER['HTTP_REFERER'];

/**
 * @package: newway
 *
 * @author: New way developer community
 *
 * @category: file manager
 *
 * @link http://github.com/naveen17797/newway
 *
 * THIS FILE IS AN INTEGRAL COMPONENT OF NEW WAY V.1.0.0.0 VIBRANIUM, AND CAN
 * BE MODIFIED, ALTERED, OR *EDITED ACCORDING TO YOUR WISH. IT'S FREE AND
 * OPENSOURCE SOFTWARE.
 *
 *
 *
 */
?>
<html>
<title>rename | newway</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/font.css" />
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
<div class="col-xs-12 col-lg-12 col-md-4 text-left">
<h1>
<i class="fa fa-shield"></i>&nbsp;New Way
</h1>
<br /><br /><br /><br /><br />
</div>
<div class="col-xs-4 col-lg-4 col-md-2"></div>
<div class="col-xs-4 col-lg-4 col-md-2 text-center" style="border: 1px solid #eee; border-top: none;">

<h1><i class='fa fa-pencil'></i>&nbsp;rename</h1>

<h3>
<br /><br />
 rename <br /><br /><?php echo htmlentities($_GET['name']); ?><br /><br />to
 <form action="rename.php" method="POST">
 <br />
 <?php $location = htmlentities($_GET['location']); echo "<input type='hidden' style='display:none;' value='$location' name='location'>"; ?>

  <?php $oldname = htmlentities($_GET['name']); echo "<input type='hidden' style='display:none;' value='$oldname' name='oldname'>"; ?>

<?php  echo "<input type='hidden' style='display:none;' value='$url' name='redirect'>"; ?>


<input type="text" class="form-control" placeholder="new name" name="rename">
<br />
<br />



<input type="submit" class="btn btn-success" value="Rename">

 </form>
</h3>

</div>

<?php
if (empty($_SESSION['access_key'])) {

    header("location: 404.php");

} elseif (isset($_POST['rename']) && isset($_POST['location']) && isset($_POST['oldname'])) {

    if (!empty($_POST['rename']) && !empty($_POST['location']) && !empty($_POST['oldname'])) {

        $loc = $_POST['location'];
        $new_name = $_POST['rename'];
        $old_name = $_POST['oldname'];

        $re = $_POST['redirect'];
        $ol = $loc.$old_name;

        $ne = $loc.$new_name;

        if  (rename($ol, $ne)) {
            header("location: $re");
        } else {
            header("location: chmod.php");
        }

    } else {

        header("location: $re");

    }

}
?>
