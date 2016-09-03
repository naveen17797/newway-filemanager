<?php 
class login {

	public function __construct($username, $password) {

$this->log($username, $password);

	}




public function log ($username, $password) {

if ($username == 'admin' && $password == 'admin') {


	


$_SESSION['id'] = str_shuffle("abcdefghijklmn");
header("location: index.php");
 



}





}



}














?>