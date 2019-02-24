<?php

class Assignment {
	
	private $assignment_id; // key
	private $section_id;	// key
	private $tutorial_lab_id;
	private $assignment_name;
	private $date_assigned;
	private $date_due;
	private $points_possible;		
	private $notes;	
	
	public function __construct() {}

	public function initialize($assignment_id, $section_id, $tutorial_lab_id, $date_assigned, 
							$assignment_name, $date_due, $points_possible, $notes)
	{
		$this->assignment_id = $assignment_id;
		$this->section_id = $section_id;
		$this->tutorial_lab_id = $tutorial_lab_id;
		$this->assignment_name = $assignment_name;
		$this->date_assigned = $date_assigned;
		$this->date_due = $date_due;	
		$this->points_possible = $points_possible;
		$this->notes = $notes;
	}
	
	
	public function get_assignment_id()
	{
		return $this->assignment_id;
	}

	public function set_assignment_id($assignment_id)
	{
		$this->assignment_id = $assignment_id;
	}
	
	public function get_section_id()
	{
		return $this->section_id;
	}

	public function set_section_id($section_id)
	{
		$this->section_id = $section_id;
	}
	
	public function get_tutorial_lab_id()
	{
		return $this->tutorial_lab_id;
	}

	public function set_tutorial_lab_id($tutorial_lab_id)
	{
		$this->tutorial_lab_id = $tutorial_lab_id;
	}
	
	public function get_assignment_name()
	{
		return $this->assignment_name;
	}

	public function set_assignment_name($assignment_name)
	{
		$this->assignment_name = $assignment_name;
	}
	
	public function get_date_assigned()
	{
		return $this->date_assigned;
	}

	public function set_date_assigned($date_assigned)
	{
		$this->date_assigned = $date_assigned;
	}
	
	public function get_date_due()
	{
		return $this->date_due;
	}

	public function set_date_due($date_due)
	{
		$this->date_due = $date_due;
	}
		
	public function get_points_possible()
	{
		return $this->points_possible;
	}

	public function set_points_possible($points_possible)
	{
		$this->points_possible = $points_possible;
	}
	
	public function get_notes()
	{
		return $this->notes;
	}

	public function set_notes($notes)
	{
		$this->notes = $notes;
	}
	
}

?>