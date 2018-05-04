<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 

require 'functions.php';

$language = loadLanguageSettings("language_conf.json");

require __DIR__."/languages/$language.php";

?>