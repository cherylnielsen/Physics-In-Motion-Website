<?php

class Student {
	
	private $student_id;	// key
	private $school_name;
	
	public function __construct() {}

	public function initialize($student_id, $school_name)
	{
		$this->student_id = $student_id;
		$this->school_name = $school_name;
	}
	
	
	public function get_student_id()
	{
		return $this->student_id;
	}

	public function set_student_id($student_id)
	{
		$this->student_id = $student_id;
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