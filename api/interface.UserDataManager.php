<?php

require_once 'class.User.php';

interface UserDataManager {

	public function getUserData(string $email, string $password):?User;


}