<?php

class Tutorial_lab {
	
	private $lab_id;
	private $lab_name;
	private $web_link;
	private $lab_status;
	private $short_description;
	private $prerequisites;
	private $key_topics;
	private $key_equations;	
	private $long_description;
	private $instructions;
	
	public function __construct() {}
	
	public function Tutorial_lab($lab_id, $lab_name, $web_link, $lab_status, $short_description, $prerequisites, $key_topics, $key_equations, $long_description, $instructions)
	{
		$this->lab_id = $lab_id;
		$this->lab_name = $lab_name;
		$this->web_link = $web_link;
		$this->lab_status = $lab_status;
		$this->short_description = $short_description;
	}

	
	public function initialize($lab_id, $lab_name, $web_link, $lab_status, $short_description, $prerequisites, $key_topics, $key_equations, $long_description, $instructions)
	{
		$this->lab_id = $lab_id;
		$this->lab_name = $lab_name;
		$this->web_link = $web_link;
		$this->lab_status = $lab_status;
		$this->short_description = $short_description;
		$this->prerequisites = $prerequisites;
		$this->key_topics = $key_topics;
		$this->key_equations = $key_equations;
		$this->long_description = $long_description;
		$this->instructions = $instructions;
	}
	
	
	public function get_lab_id()
	{
		return $this->lab_id;
	}

	public function set_lab_id($lab_id)
	{
		$this->lab_id = $lab_id;
	}
	
	public function get_lab_name()
	{
		return $this->lab_name;
	}

	public function set_lab_name($lab_name)
	{
		$this->lab_name = $lab_name;
	}
	
	public function get_web_link()
	{
		return $this->web_link;
	}

	public function set_web_link($web_link)
	{
		$this->web_link = $web_link;
	}
	
	public function get_lab_status()
	{
		return $this->lab_name;
	}

	public function set_lab_status($lab_status)
	{
		$this->lab_status = $lab_status;
	}
	
	public function get_short_description()
	{
		return $this->short_description;
	}

	public function set_short_description($short_description)
	{
		$this->short_description = $short_description;
	}
	
	public function get_prerequisites()
	{
		return $this->prerequisites;
	}

	public function set_prerequisites($prerequisites)
	{
		$this->prerequisites = $prerequisites;
	}
	
	public function get_key_topics()
	{
		return $this->key_topics;
	}

	public function set_key_topics($key_topics)
	{
		$this->key_topics = $key_topics;
	}
	
	public function get_key_equations()
	{
		return $this->key_equations;
	}

	public function set_key_equations($key_equations)
	{
		$this->key_equations = $key_equations;
	}
	
	public function get_long_description()
	{
		return $this->long_description;
	}

	public function set_long_description($long_description)
	{
		$this->long_description = $long_description;
	}
	
	public function get_instructions()
	{
		return $this->instructions;
	}

	public function set_instructions($instructions)
	{
		$this->instructions = $instructions;
	}
}

?>