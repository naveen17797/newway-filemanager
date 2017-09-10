<meta charset="utf-8">
<?php

require 'functions.php';

$language = loadLanguageSettings("language_conf.json");

require __DIR__."/languages/$language.php";

?>