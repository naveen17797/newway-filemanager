<?php
class jsonHandler
{

    /** @var string */
	private $filename;

    /** @var string */
	private $json_data;

    /** @var array */
	private $json_array = array();

    /** @var array */
	private $keys = array();

    /** @var array */
	private $values = array();

	public function __construct($filename)
    {
		$this->filename = $filename;
		if (file_exists($filename)) {
			$this->json_data = file_get_contents($filename);
			$this->store_keys_and_values();
		}
	}

    /**
     * Retrieve all keys from json array
     *
     * @return array
     */
	public function getAllKeys()
    {
		return $this->keys;
	}

    /**
     * Store keys and values to json file
     *
     * @return void
     */
	private function store_keys_and_values()
    {
		$this->json_array = json_decode($this->json_data, true);
		foreach ($this->json_array as $key => $value) {
			array_push($this->keys, $key);
			array_push($this->values, $value);
		}
	}

    /**
     * Find key by index
     *
     * @return string
     */
	private function find_key_index($key)
    {
		$index = array_search($key, $this->keys);
		return $index;
	}

    /**
     * Check if key exists
     *
     * @return bool
     */
	public function check_if_key_exists($key)
    {
        return (in_array($key, $this->keys));
	}

    /**
     * Get value by key
     *
     * @return string
     */
	public function get_value_by_key($key)
    {
		$index = $this->find_key_index($key);
		$value = $this->values[$index];
		return $value;
	}

    /**
     * Rewrite value of given key
     * 
     * @return void
     */
	public function rewrite_the_value($key, $new_value)
    {
		$this->json_array[$key] = $new_value;
		$this->update_json_file();
	}

    /**
     * Create a new key value pair
     *
     * @return void
     */
	public function create_key_value($key, $value)
    {
		$this->json_array[$key] = $value;
		$this->update_json_file();
	}

    /**
     * Update json file with new json array data
     *
     * @return void
     */
	private function update_json_file()
    {
		$changed_json_data = json_encode($this->json_array);
		$handle = fopen($this->filename, "w");
		fwrite($handle, $changed_json_data);
		fclose($handle);
	}

    /**
     * Remove key value pair from json array
     *
     * @return void
     */
	public function remove_key($key)
    {
		unset($this->json_array[$key]);
		$this->update_json_file();
	}
}
