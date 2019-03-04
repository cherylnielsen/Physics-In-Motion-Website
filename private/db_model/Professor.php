<?php

class Professor {
	
	protected $professor_id;	// key
	protected $school_name;

	public function __construct() {}
	
	public function initialize($professor_id, $school_name)
	{
		$this->professor_id = $professor_id;
		$this->school_name = $school_name;
	}
	
	
	public function get_professor_id()
	{
		return $this->professor_id;
	}

	public function set_professor_id($professor_id)
	{
		$this->professor_id = $professor_id;
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