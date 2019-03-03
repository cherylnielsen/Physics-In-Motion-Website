<?php

class Professor_Member_View  extends Professor{
	
	private $first_name;	
	private $last_name;
	private $email; 
	
	public function __construct() {}
	

	public function initializeView($professor_id, $school_name, $first_name, 
									$last_name, $email)
	{
		$this->professor_id = $professor_id;
		$this->school_name = $school_name;
		$this->set_first_name($first_name);
		$this->set_last_name($last_name);
		$this->set_email($email);		
	}
	
	
	public function get_first_name()
	{
		return $this->first_name;
	}

	public function set_first_name($first_name)
	{
		$this->first_name = $first_name;
	}
	
	public function get_last_name()
	{
		return $this->last_name;
	}
	
	public function set_last_name($last_name)
	{
		$this->last_name = $last_name;
	}
	
	public function get_email()
	{
		return $this->email;
	}

	public function set_email($email)
	{
		$this->email = $email;
	}
	
	
}

?>