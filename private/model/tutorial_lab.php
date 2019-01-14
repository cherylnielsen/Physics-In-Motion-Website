<?php

class Tutorial_Lab {
	
	private $lab_id;
	private $lab_name;
	private $web_link;
	
	// lab_status allowed value set is: New, Updated, Available, Development, Discontinued
	// default value is: "Development"
	private $lab_status;
	private $lab_status_array;
	 
	private $introduction;
	private $prerequisites;
	private $key_topics;
	private $key_equations;	
	private $description;
	private $instructions;
	private $date_first_available;
	
	public function __construct() {}

	
	public function initialize($lab_id, $lab_name, $web_link, $lab_status, $introduction, $prerequisites, $key_topics, 
	$key_equations, $description, $instructions)
	{
		$this->lab_id = $lab_id;
		$this->lab_name = $lab_name;
		$this->web_link = $web_link;
		
		// lab_status allowed value set
		$this->lab_status_array = array('New', 'Updated', 'Available', 'Development', 'Discontinued');	
		// Make sure value is an allowed value, otherwise use the default value.
		$this->set_lab_status($lab_status);
				
		$this->introduction = $introduction;
		$this->prerequisites = $prerequisites;
		$this->key_topics = $key_topics;
		$this->key_equations = $key_equations;
		$this->description = $description;
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
		return $this->lab_status;
	}

	public function set_lab_status($lab_status)
	{
		// Make sure value is an allowed value, otherwise use the default value of "Development".
		if(in_array($lab_status, $lab_status_array)
		{
			$this->lab_status = $lab_status;
		}
		else
		{
			$this->lab_status = "Development";
		}
	}
	
	public function get_introduction()
	{
		return $this->introduction;
	}

	public function set_introduction($introduction)
	{
		$this->introduction = $introduction;
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