<?php

class Assignment_View extends Assignment{
	
	private $section_name;
	private $professor_id;
	private $professor_first_name;
	private $school_name;
	
	private $tutorial_lab_name;
	private $tutorial_lab_introduction;
	private $tutorial_lab_web_link;
	
	
	public function __construct() {}

	public function initializeView($assignment_id, $section_id, $tutorial_lab_id, $date_assigned, 
						$assignment_name, $date_due, $points_possible, $notes,
						$section_name, $professor_id, $professor_first_name, 
						$professor_last_name, $school_name,
						$tutorial_lab_name, $tutorial_lab_introduction, $tutorial_lab_web_link)
	{
		$this->initialize($assignment_id, $section_id, $tutorial_lab_id, $assignment_name, 
							$date_assigned, $date_due, $points_possible, $notes)
		
		$this->set_section_name($section_name);
		$this->set_professor_id($professor_id);
		$this->set_professor_first_name($professor_first_name);
		$this->set_professor_last_name($professor_last_name);
		$this->set_school_name($school_name);
		
		$this->set_tutorial_lab_name($tutorial_lab_name);
		$this->set_tutorial_lab_introduction($tutorial_lab_introduction);
		$this->set_tutorial_lab_web_link($tutorial_lab_web_link);		
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
	
	public function get_tutorial_lab_name()
	{
		return $this->tutorial_lab_name;
	}

	public function set_tutorial_lab_name($tutorial_lab_name)
	{
		$this->tutorial_lab_name = $tutorial_lab_name;
	}
	
	public function get_tutorial_lab_web_link()
	{
		return $this->tutorial_lab_web_link;
	}

	public function set_tutorial_lab_web_link($tutorial_lab_web_link)
	{
		$this->tutorial_lab_web_link = $tutorial_lab_web_link;
	}
	
	public function get_tutorial_lab_introduction()
	{
		return $this->tutorial_lab_introduction;
	}

	public function set_tutorial_lab_introduction($tutorial_lab_introduction)
	{
		$this->tutorial_lab_introduction = $tutorial_lab_introduction;
	}
	
	
}

?>