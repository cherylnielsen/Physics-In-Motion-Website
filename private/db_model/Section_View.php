<?php


class Section_View extends Section {
	
	private $professor_first_name;
	private $professor_last_name;
	private $school_name;

	
	public function __construct() {}
	
	
	public function initializeView($section_id, $section_name, $start_date, $end_date, 
								$section_description, 
								$professor_id, $professor_first_name, $professor_last_name, 
								$school_name)
	{
		$this->initialize($section_id, $section_name, $professor_id, $start_date, 
							$end_date, $section_description);
		$this->professor_first_name = $professor_first_name;
		$this->professor_last_name = $professor_last_name;
		$this->school_name = $school_name;
	}
	
	
	public function get_professor_first_name()
	{
		return $this->professor_first_name;
	}
	
	public function set_professor_first_name($professor_first_name)
	{
		$this->professor_first_name = $professor_first_name;
	}
	
	public function get_professor_last_name()
	{
		return $this->professor_last_name;
	}
	
	public function set_professor_last_name($professor_last_name)
	{
		$this->professor_last_name = $professor_last_name;
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