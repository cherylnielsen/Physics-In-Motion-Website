<?php

class Student_Member_View  {
	
	private $student_id;	// key
	private $first_name;
	private $student_name;
	private $email; 
	private $school_name;
	
	public function __construct() {}
	

	public function initialize($student_id, $student_name, $email, $school_name)
	{
		$this->set_student_id($student_id);
		$this->set_student_name($student_name);
		$this->set_email($email);
		$this->set_school_name($school_name);		
	}
	
	
	public function get_student_id()
	{
		return $this->student_id;
	}

	public function set_student_id($student_id)
	{
		$this->student_id = $student_id;
	}
	
	public function get_student_name()
	{
		return $this->student_name;
	}

	public function set_student_name($student_name)
	{
		$this->student_name = $student_name;
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