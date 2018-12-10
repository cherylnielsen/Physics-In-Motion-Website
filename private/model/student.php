<?php

class Student {
	
	private $student_id;
	private $user_id;	
	private $first_name;
	private $last_name;
	private $school_type;
	private $school_name;
	
	
	public function Student() {}
	
	public function Student($student_id, $user_id, $first_name, $last_name, $school_type, $school_name)
	{
		$this->student_id = $student_id
		$this->user_id = $user_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->school_type = $school_type;
		$this->school_name = $school_name;
	}

	public function initialize($student_id, $user_id, $first_name, $last_name, $school_type, $school_name)
	{
		$this->student_id = $student_id
		$this->user_id = $user_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->school_type = $school_type;
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
	
	public function get_user_id()
	{
		return $this->user_id;
	}

	public function set_user_id($user_id)
	{
		$this->user_id = $user_id;
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
	
	
}

?>