<?php

class Tutorial_Lab {
	
	// lab_status allowed value set is: New, Updated, Available, Development, Discontinued
	// default value is: "Development"
	private $lab_status;
	private $allowed_lab_status_values = array('New', 'Updated', 'Available', 'Development', 'Discontinued');	
	
	private $tutorial_lab_id;	// key
	private $tutorial_lab_name;	// unique
	private $tutorial_lab_web_link;	// unique
	private $tutorial_lab_introduction;
	private $prerequisites;
	private $key_topics;
	private $key_equations;	
	private $description;
	private $instructions;
	private $date_first_available;
	
	public function __construct() {}

	
	public function initialize($tutorial_lab_id, $tutorial_lab_name, $tutorial_lab_web_link, $lab_status, $tutorial_lab_introduction)
	{
		$this->tutorial_lab_id = $tutorial_lab_id;
		$this->tutorial_lab_name = $tutorial_lab_name;
		$this->tutorial_lab_web_link = $tutorial_lab_web_link;
		$this->tutorial_lab_introduction = $tutorial_lab_introduction;
		// Make sure value is an allowed value, otherwise use the default value.
		$this->set_lab_status($lab_status);
	}
	
	
	public function get_tutorial_lab_id()
	{
		return $this->tutorial_lab_id;
	}

	public function set_tutorial_lab_id($tutorial_lab_id)
	{
		$this->tutorial_lab_id = $tutorial_lab_id;
	}
	
	public function get_tutorial_lab_name()
	{
		return $this->tutorial_lab_name;
	}

	public function set_tutorial_lab_name($tutorial_lab_name)
	{
		$this->tutorial_lab_name = $tutorial_lab_name;
	}
	
	public function get_tutorial_lab_web_link()
	{
		return $this->tutorial_lab_web_link;
	}

	public function set_tutorial_lab_web_link($tutorial_lab_web_link)
	{
		$this->tutorial_lab_web_link = $tutorial_lab_web_link;
	}
	
	public function get_lab_status()
	{
		return $this->lab_status;
	}

	public function set_lab_status($lab_status)
	{
		// Make sure value is an allowed value, otherwise use the default value of "Development".
		if(in_array($lab_status, $this->allowed_lab_status_values))
		{
			$this->lab_status = $lab_status;
		}
		else
		{
			$this->lab_status = "Development";
		}
	}
	
	public function get_allowed_lab_status_values()
	{
		return $this->allowed_lab_status_values;
	}
	
	public function get_tutorial_lab_introduction()
	{
		return $this->tutorial_lab_introduction;
	}

	public function set_tutorial_lab_introduction($tutorial_lab_introduction)
	{
		$this->tutorial_lab_introduction = $tutorial_lab_introduction;
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
	
	public function get_description()
	{
		return $this->description;
	}

	public function set_description($description)
	{
		$this->description = $description;
	}
	
	public function get_instructions()
	{
		return $this->instructions;
	}

	public function set_instructions($instructions)
	{
		$this->instructions = $instructions;
	}
	
	public function get_date_first_available()
	{
		return $this->date_first_available;
	}

	public function set_date_first_available($date_first_available)
	{
		$this->date_first_available = $date_first_available;
	}
	
	
}

?>