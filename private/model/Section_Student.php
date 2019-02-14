<?php

class Section_Student {
	
	private $section_id;
	private $student_id;
	private $dropped_section;
	private $reviewed_section;
	
	public function __construct() {}
	
	public function initialize($section_id, $student_id, $dropped_section = false, $reviewed_section = false)
	{
		$this->section_id = $section_id;
		$this->student_id = $student_id;
		$this->dropped_section = $dropped_section;
		$this->reviewed_section = $reviewed_section;
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
	
	public function get_dropped_section()
	{
		return $this->dropped_section;
	}

	public function set_dropped_section($dropped_section)
	{
		$this->dropped_section = $dropped_section;
	}
	
	public function get_reviewed_section()
	{
		return $this->reviewed_section;
	}

	public function set_reviewed_section($reviewed_section)
	{
		$this->reviewed_section = $reviewed_section;
	}
	
}

?>