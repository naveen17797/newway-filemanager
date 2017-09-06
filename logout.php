<?php

require 'functions.php';

session_start();


session_destroy();



$message = "Logout Function: The admin has been logged out at $date";

writeLog($message);


header("location: jls-login.php");



?>