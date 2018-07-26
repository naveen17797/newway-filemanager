<?php

class jsonHandler {
	private $filename;
	private $json_data;
	private $json_array = array();
	private $keys = array();
	private $values = array();

	public function __construct($filename) {
		$this->filename = $filename;
		if (file_exists($filename)) {
			$this->json_data = file_get_contents($filename);
			$this->store_keys_and_values();
		}
		
	}

	private function store_keys_and_values() {
		$this->json_array = json_decode($this->json_data, true);
		foreach ($this->json_array as $key => $value) {
			array_push($this->keys, $key);
			array_push($this->values, $value);

		}
	}

	private function find_key_index($key) {
		$index = array_search($key, $this->keys);
		return $index;
	}

	public function check_if_key_exists($key) {
		if (in_array($key, $this->keys)) {
			return true;
		}
		else {
			return false;
		}
	}

	public function get_value_by_key($key) {
		$index = $this->find_key_index($key);
		$value = $this->values[$index];
		return $value;
	}

	public function rewrite_the_value($key, $changed_value){
		$this->json_array[$key] = $changed_value;
		$this->update_json_file();
	}

	public function create_key_value($key, $value) {
		$this->json_array[$key] = $value;
		$this->update_json_file();
	}

	private function update_json_file() {
		$changed_json_data = json_encode($this->json_array);
		$handle = fopen($this->filename, "w");
		fwrite($handle, $changed_json_data);
		fclose($handle);
	}

	private function remove_key($key) {
		unset($this->json_data[$key]);
		$this->update_json_file();
	}
}




?>