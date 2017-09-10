<?php session_start();
require 'header.php';?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<link rel="stylesheet" type="text/css" href="css/materialize.css">
<TITLE><?php echo $newway['title']; ?></TITLE>
<div class="col-xs-12 text-left black" style="color: white;">
<h2><i class="fa fa-shield"></i>&nbsp;<?php echo $newway['title']; ?></h2>
</div>
<div class="col-xs-12">
<br /><br />
<h4 class="btn btn-large red"><?php echo $newway['newway_logs'];?></h4>
<br /><br />
</div>

<style type="text/css">

</style>
<?php

if (empty($_SESSION['access_key'])) {
header("location: jls-login.php");
exit();
}



/*
$file1 = "logs.txt";
$lines = file($file1);
foreach($lines as $line_num => $line)
{
echo "<br />";
echo $line;
echo "<br>";
}
*/
$data = file_get_contents("logs.txt");
echo "<textarea class='form-control' rows=20>$data</textarea>";
?>