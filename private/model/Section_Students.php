<?php

class Section_Students {
	
	private $section_id;
	private $student_id;
	
	public function __construct() {}
	
	public function initialize($section_id, $student_id)
	{
		$this->section_id = $section_id;
		$this->student_id = $student_id;
	}
	
	
	public function get_section_id()
	{
		return $this->section_id;
	}

	public function set_section_id($section_id)
	{
		$this->section_id = $section_id;
	}
	
	public function get_student_id()
	{
		return $this->student_id;
	}

	public function set_student_id($student_id)
	{
		$this->student_id = $student_id;
	}
	
	
}

?>