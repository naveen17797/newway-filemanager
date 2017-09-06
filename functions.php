<?php

$date = date("d-m-Y h:i:s A");

function createFile($condition, $data, $argument, $filename) {

	if ($condition) {

		return false;

	}
	else {

		$array = array($argument=>$data);

		$data = json_encode($array);

		$fp = fopen($filename, "w");

		fwrite($fp, $data);

		fclose($fp);

		return true;



	}

}

function editLanguage($data, $argument, $folder) {

	$php = ".php";

	

	if (file_exists($folder.$data.$php)) 
	{

	
		unlink("language_conf.json");
		$handle = fopen("language_conf.json", "w");
		$array = array($argument=>$data);
		$json = json_encode($array);
		fwrite($handle, $json);
		fclose($handle);
		return true;
	}
	else {
		return false;
	}
	



}

function getCurrentLanguage($filename) {


	$json = file_get_contents($filename);

	$array = json_decode($json, true);


	return $array['language'];


}


function languagesAvailable($array) {

$option_open = "<option value=";



$option_close = "</option>";

for ($i = 0; $i<count($array); $i++) {

echo $option_open.$array[$i].">".$array[$i].$option_close;


}


}




function alert($text) {

echo "<script>alert('$text');</script>";


}

function loadLanguageSettings($filename) {

$data = file_get_contents($filename);

$array = json_decode($data, true);

$language =  $array['language'];

return $language;


}


function writeLog($message) {

	$date = date("d-m-Y h:i:s A");

	if(file_exists("logs.txt")) {



	$fp = fopen("logs.txt", "a");

	}

	else {
		$fp = fopen("logs.txt", "w");
	}

	$newline = "\n";

	$message = $message.$newline;

	fwrite($fp, $message);

	fclose($fp);


}

?>