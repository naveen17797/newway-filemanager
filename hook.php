<?php 
//CONFIGURABLES
/**
*@var bool $readAccess
*@var bool $writeAccess
*@var bool $deleteAccess
**/
class ConfigParameters {

	private $readAccess = 0;
	private $createAccess = 0;
	private $deleteAccess = 0;	
	private $username;	

	public function __construct($username, $readAccess, $writeAccess, $deleteAccess) {
		$this->readAccess  = $readAccess;
		$this->writeAccess = $writeAccess;
		$this->deleteAccess = $deleteAccess;
	}

	public function getReadAccess() {
		return $this->readAccess;
	}

	public function getWriteAccess() {
		return $this->writeAccess;
	}

	public function getDeleteAccess() {
		return $this->deleteAccess;
	}

	public function getUserName() {
		return this->$username;
	}

	
}



?>