<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<link rel="stylesheet" type="text/css" href="css/materialize.css">
<title>Language Manager | Newway</title>
<?php
session_start();

if (empty($_SESSION['access_key'])) {

header('Location: jls-login.php');


exit();




}


require 'functions.php';

require 'language_registry.php';



$data = "english";
$argument = "language";
$filename = "language_conf.json";
$condition = file_exists($filename);


        if ($condition) {

        }
        else {


            createFile($condition, $data, $argument, $filename);
        }


?>
<div class="col-xs-12 black" style="color: white;">
<h3><i class="fa fa-shield"></i>&nbsp;Newway</h3>
</div>
<div class="col-xs-12 text-center" style="border: 10px solid #eee;">
<h4>Welcome to Newway Language Manager</h4>
<br /><h5 class="btn btn-large blue full"><i class='fa fa-gear'></i>&nbsp;choose your language</h5>
<br /><br />
<form method="POST">
your current language: <?php echo  getCurrentLanguage($filename); ?>
<br /><br />
choose your language:
<select name="language">
<?php languagesAvailable($languages_available); ?>
</select>
<br /><br />
<input type="submit" class="btn btn-large yellow darken-3" value="save settings">
</form>
</div>
<style type="text/css">
    @font-face {
        font-family: ubu;
        src: url("fonts/ubuntu.ttf");
    }
    body {
        font-family: ubu;

    }
    .full {
        width: 100%;
    }
</style>


<?php
if (isset($_POST)) {


    if (!empty($_POST)) {

        $language = $_POST['language'];

        $folder = "languages/";

        $data = $_POST['language'];

        $argument = "language";

        if (editLanguage($data, $argument, $folder)) {
            header("location: language_manager.php");
        }
        else {
            alert("failed to change the language");
        }

    }
}


?>