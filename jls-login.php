  <?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font.css">
<link rel="stylesheet" type="text/css" href="css/materialize.css">
          <div><br/><br/><br/><br/><br/><br/></div>
  <!-- Compiled and minified JavaScript -->
<div class="col-xs-3"></div>
  <div class="col-xs-6 text-center" id='box'>
<?php 
/**
*@author: Naveen
*
*@link: http://www.github.com/naveen17797/

*/
class jls {


public function checkUserAlreadyRegistered () {

  if (file_exists("jls-login.json"))
   {

	return true;


    }

  else {

	  return false;

    }


}








private function loadloginform() {
	$this->displaylogintemplate();
}





private function displaylogintemplate() {

$logintemplate = "
<h4>Login</h4>
<br/><br/><br/>
<form method='POST'>
<input type='text' name='log-email' placeholder='enter your email id'><br/><br/>
<input type='password' name='log-password' placeholder='enter your password'><br/><br/>
<input type='submit' class='btn btn-large purple' value='log in'>


</form>
";

echo $logintemplate;

}








public function loadjls() {

if ($this->checkUserAlreadyRegistered()) {
$this->loadloginform();


}

else {



$this->loadRegistrationform();

}


}






private function loadRegistrationform() {


$this->displayregistrationtemplate();



}






private function displayregistrationtemplate() {


$template = "
<h4>Register</h4>
<br/><br/>
<form method='POST'>
<input type='text' name='email' placeholder='enter your email id'><br/><br/>
<input type='password' name='password' placeholder='password' placeholder='enter your password'>
<br/><br/>
<input type='password' name='repassword' placeholder='renenter your password'>
<br/><br/>
<input type='submit' class='btn btn-large red' value='register'>
</form>


";

echo $template;




}








public function createuserentry($email, $password, $filename, $success_message) {


if ($fo = fopen($filename, w)) {

    fclose($fo);
	$this->createjsonfile($email, $password, $filename);
	echo $success_message;
	header("location: jls-login.php");

}
else {

	$file_Error = "the file cant be created due to no suitable permisisons";


	echo $file_Error;


}

}







private function createjsonfile($email, $password, $filename) {

$handle = fopen($filename, "w");


$password = password_hash($password, PASSWORD_DEFAULT);

$email = password_hash($email, PASSWORD_DEFAULT);


$array = array("email"=>$email, "password"=>$password);

$string = json_encode($array);


fwrite($handle, $string);

fclose($handle);



}





public function login($email, $password) {

$data = file_get_contents("jls-login.json");

$json = json_decode($data, true);




$j_email = $json['email'];

$j_password = $json['password'];


if (password_verify($email, $j_email)) {

	if (password_verify($password, $j_password)) {


		$_SESSION['access_key'] = $j_password;

		header("location: index.php");

	

	}
	else {

		echo "the password is incorrect";
	}

}

else {

echo "the email id you have entered is incorrect";


}



}











}





$jls = new jls;


$jls->loadjls();





if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword'])) {

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {

  		if ($jls->checkUserAlreadyRegistered()) {

  			echo "a user has been already registered, no users can be added further";
  		}

  		else {

  		$password = $_POST['password'];

  		$repassword = $_POST['repassword'];

  		$email = $_POST['email'];

  		$success_message = "success , your email id has been registered";

  		$filename = "jls-login.json";

      if ($password == $repassword) {
  	    $jls->createuserentry($email, $password, $filename, $success_message);
  	   }
  	   else {
  	   	echo "both passwords are not same, retype and submit";
  	   }
  	}
  }

}



if (isset($_POST['log-email']) && isset($_POST['log-password'])) {

	if (!empty($_POST['log-email']) && !empty($_POST['log-password'])) {

		$log_email = $_POST['log-email'];

		$log_password = $_POST['log-password'];

			if ($jls->checkUserAlreadyRegistered()) {

				$jls->login($log_email, $log_password);
			}

			else {

			}

	}


}






























?>
</div>
<style type="text/css">
	#box {
		border: 40px solid #eee;
		background-color: #fff;
	}
	body {
		background-color: #eee;
	}
	input[type='text'], input[type='password']{
		width: 300px;
	}
</style>
<title>Json Login System[JLS]</title>