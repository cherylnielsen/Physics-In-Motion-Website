<?php

class Section {
	
	private $section_id;
	private $section_name;
	private $professor_id;
	private $start_date;
	private $end_date;
	private $section_student_array;
	
	
	public function __construct() {}
	
	
	public function initialize($section_id, $section_name, $professor_id, $start_date, $end_date)
	{
		$this->section_id = $section_id;
		$this->section_name = $section_name;
		$this->professor_id = $professor_id;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->section_student_array = array();		
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
	
	public function get_professor_id()
	{
		return $this->professor_id;
	}

	public function set_professor_id($professor_id)
	{
		$this->professor_id = $professor_id;
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
	
	public function get_student_array()
	{
		return $this->section_student_array;
	}

	public function set_student_array($section_student_array)
	{
		$this->section_student_array = $section_student_array;
	}
	
	
}

?>