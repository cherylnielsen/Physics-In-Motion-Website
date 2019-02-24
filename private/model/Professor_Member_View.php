<?php

class Professor_Member_View  {
	
	private $professor_id;	// key
	private $professor_name;
	private $email; 
	private $school_name;
	
	public function __construct() {}
	

	public function initialize($professor_id, $professor_name, $email, $school_name)
	{
		$this->set_professor_id($professor_id);
		$this->set_professor_name($professor_name);
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
	
	public function get_professor_name()
	{
		return $this->professor_name;
	}
	
	public function set_professor_name($professor_name)
	{
		$this->professor_name = $professor_name;
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