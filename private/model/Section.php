<?php

class Section {
	
	private $section_id;
	private $section_name;
	private $start_date;
	private $end_date;
	private $section_students;
	private $section_profesors;
	
	public function __construct() {}
	
	public function initialize($section_id, $section_name, $start_date, $end_date, $professor_array, $student_array)
	{
		$this->section_id = $section_id;
		$this->section_name = $section_name;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->profesor_array = array();
		$this->student_array = array();
		array_merge($this->profesor_array, $professor_array);
		array_merge($this->student_array, $student_array);
		
	}
	
	
	public function get_section_id()
	{
		return $this->section_id;
	}

	public function set_section_id($section_id)
	{
		$this->section_id = $section_id;
	}
	
	public function get_section_name()
	{
		return $this->section_name;
	}

	public function set_section_name($section_name)
	{
		$this->section_name = $section_name;
	}
	
	public function get_start_date()
	{
		return $this->start_date;
	}

	public function set_start_date($start_date)
	{
		$this->start_date = $start_date;
	}
	
	public function get_end_date()
	{
		return $this->end_date;
	}

	public function set_end_date($end_date)
	{
		$this->end_date = $end_date;
	}
	
	
}

?>