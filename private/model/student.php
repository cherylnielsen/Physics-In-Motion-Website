<?php

class Student {
	
	private $member_id;	// key
	private $first_name;
	private $last_name;
	private $school_name;
	private $email; 
	
	
	public function __construct() {}

	public function initialize($member_id, $first_name, $last_name, $school_name, $email)
	{
		$this->member_id = $member_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->school_name = $school_name;
		$this->email = $email;
	}
	
	public function get_member_id()
	{
		return $this->member_id;
	}

	public function set_member_id($member_id)
	{
		$this->member_id = $member_id;
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
	
	public function get_school_type()
	{
		return $this->school_type;
	}

	public function set_school_type($school_type)
	{
		$this->school_type = $school_type;
	}
	
	public function get_school_name()
	{
		return $this->school_name;
	}

	public function set_school_name($school_name)
	{
		$this->school_name = $school_name;
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