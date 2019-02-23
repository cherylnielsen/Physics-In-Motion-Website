<?php

class Professor_Member_View {
	
	private $professor_id;	// key
	private $first_name;
	private $last_name;
	private $email; 
	private $school_name;
	
	
	public function __construct() {}
	

	public function initialize($professor_id, $first_name, $last_name, $email, $school_name)
	{
		$this->set_professor_id($professor_id);
		$this->set_first_name($first_name);
		$this->set_last_name($last_name);
		$this->set_email($email);
		$this->set_school_name($school_name);		
	}
	
	
	public function get_professor_id()
	{
		return $this->professor_id;
	}

	public function set_professor_id($professor_id)
	{
		$this->professor_id = $professor_id;
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
	
	public function get_school_name()
	{
		return $this->school_name;
	}

	public function set_school_name($school_name)
	{
		$this->school_name = $school_name;
	}
	
	
}

?>