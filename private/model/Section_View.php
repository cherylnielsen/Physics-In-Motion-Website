<?php


class Section_View {
	
	private $section_id;
	private $section_name;
	private $start_date;
	private $end_date;
	private $professor_id;
	private $first_name;
	private $last_name;
	private $school_name;
	
	public function __construct() {}
	
	
	public function initialize($section_id, $section_name, $start_date, $end_date,
								$professor_id, $first_name, $last_name, $school_name)
	{
		$this->section_id = $section_id;
		$this->section_name = $section_name;
		$this->professor_id = $professor_id;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->school_name = $school_name;
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
			
	public function get_professor_id()
	{
		return $this->professor_id;
	}
	
	public function set_professor_id($professor_id)
	{
		$this->professor_id = $professor_id;
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