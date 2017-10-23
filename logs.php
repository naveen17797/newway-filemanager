<?php
session_start();
require 'header.php';

if (empty($_SESSION['access_key'])) {
	header("location: jls-login.php");
	exit();
}

?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<link rel="stylesheet" type="text/css" href="css/materialize.css">
<TITLE><?php echo $newway['title']; ?></TITLE>
<div class="col-xs-12 text-left black" style="color: white;">
<h2><i class="fa fa-shield"></i>&nbsp;<?php echo $newway['title']; ?></h2>
</div>
<div class="col-xs-12" align="center">
<br/><br/>
<h4><?php echo $newway['newway_logs'];?></h4>
<form method="POST">
  <?php
	if(isset($_POST['clearLogs'])){
		echo '<h5>'.$newway['are_you_sure'].'</h5>';
		echo '<a href="index.php" class="btn btn-large green">'.$newway['back'].'</a>&nbsp;';
		echo '<input class="btn btn-large green" type="submit" value="'.$newway['logs_no'].'">&nbsp;';
		echo '<input type="hidden" name="session" value="'.session_id().'">';
		echo '<input class="btn btn-large red" type="submit" name="yes" value="'.$newway['logs_yes'].'">';
	}
	else if(!empty($_POST['session'])){
		if($_POST['session'] == session_id()){
			if($tmp = fopen("logs.txt", "w")){
				$message = "Logs Cleared at ".date("d-m-y h:i:s A")."\n";
				fwrite($tmp, $message);
				fclose($tmp);
				echo "<h5>".$newway['logs_deleted']."!</h5>";
				echo '<a href="index.php" class="btn btn-large green">'.$newway['back'].'</a>&nbsp;';
			}
			else{
				echo "<h5>".$newway['logs_not_deleted'].".</h5>";
			}
		}
		else{
			echo "<h5>CSRF Detected.!!!</h5>";
		}
	}
	else{
		echo '<a href="index.php" class="btn btn-large green">'.$newway['back'].'</a>&nbsp;';
		echo '<input class="btn btn-large red" type="submit" name="clearLogs" value="'.$newway['clear_logs'].'">';
		$data = file_get_contents("logs.txt");
		echo "<textarea class='form-control' rows=20>$data</textarea>";
	}
  ?>
</form>
</div>
