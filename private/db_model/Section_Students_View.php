<?php


class Section_Students_View {
	
	private $section_id;
	private $section_name;
	private $start_date;
	private $end_date;
	private $student_id;
	private $student_first_name;
	private $student_last_name;
	private $school_name;
	private $dropped_section;

	
	public function __construct() {}
	
	
	public function initializeView($section_id, $section_name, $start_date, $end_date,
								$student_id, $student_first_name, $student_last_name, $school_name,
								$dropped_section)
	{
		$this->section_id = $section_id;
		$this->section_name = $section_name;
		$this->student_id = $student_id;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->student_first_name = $student_first_name;
		$this->student_last_name = $student_last_name;
		$this->school_name = $school_name;
		$this->dropped_section = $dropped_section;

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
			
	public function get_student_id()
	{
		return $this->student_id;
	}
	
	public function set_student_id($student_id)
	{
		$this->student_id = $student_id;
	}
	
	public function get_student_first_name()
	{
		return $this->student_first_name;
	}
	
	public function set_student_first_name($student_first_name)
	{
		$this->student_first_name = $student_first_name;
	}
	
	public function get_student_last_name()
	{
		return $this->student_last_name;
	}

	public function set_student_last_name($student_last_name)
	{
		$this->student_last_name = $student_last_name;
	}
	
	public function get_school_name()
	{
		return $this->school_name;
	}

	public function set_school_name($school_name)
	{
		$this->school_name = $school_name;
	}
	
	public function get_dropped_section()
	{
		return $this->dropped_section;
	}

	public function set_dropped_section($dropped_section)
	{
		$this->dropped_section = $dropped_section;
	}
	
	
	
}

?>