<?php

class User {

	public function __construct(string $email, int $access_level) {

		$this->access_level = $access_level;

	}

	public function canReadFiles() {

		return ($this->access_level == AccessLevel::ReadOnly ||
				$this->access_level == AccessLevel::ReadWrite ||
				$this->access_level == AccessLevel::ReadWriteDelete ||
				$this->access_level == AccessLevel::Admin);

	}

	public function canWriteFiles() {

		return ($this->access_level == AccessLevel::ReadWrite ||
				$this->access_level == AccessLevel::ReadWriteDelete ||
				$this->access_level == AccessLevel::Admin);
	}

	public function canDeleteFiles() {

		return ($this->access_level == AccessLevel::ReadWriteDelete ||
				$this->access_level == AccessLevel::Admin);
	}

	public function canAddUsers() {
		return $this->access_level == AccessLevel::Admin;
	}
	
}

?>