<?php


class Homework_View extends Homework {
	
	private $student_first_name;
	private $student_last_name;
	private $school_name;
	private $assignment_name; 
	private $tutorial_lab_id; 
	private $points_possible;
	
	
	public function __construct() {}
	
	public function initializeView($homework_id, $section_id, $assignment_id, 
								$assignment_name, $tutorial_lab_id, $student_id, 
								$lab_summary, $lab_data, $graphs, $math, $hints, $chat_session,
								$date_submitted, $filepath, 
								$student_first_name, $student_last_name, $school_name,
								$points_possible,
								$points_earned = 0, $was_graded = false, $hours = 0)
	{
		$this->initialize($homework_id, $section_id, $assignment_id, $student_id, 
								$lab_summary, $lab_data, $graphs, $math, $hints, $chat_session,
								$date_submitted, $filepath, $points_earned, $was_graded, $hours);
								
		$this->student_first_name = $student_first_name;
		$this->student_last_name = $student_last_name;
		$this->school_name = $school_name;
		$this->assignment_name = $assignment_name; 
		$this->tutorial_lab_id = $tutorial_lab_id; 
		$this->points_possible = $points_possible; 
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
	
	public function get_assignment_name()
	{
		return $this->assignment_name;
	}

	public function set_assignment_name($assignment_name)
	{
		$this->assignment_name = $assignment_name;
	}
	
	public function get_tutorial_lab_id()
	{
		return $this->tutorial_lab_id;
	}

	public function set_tutorial_lab_id($tutorial_lab_id)
	{
		$this->tutorial_lab_id = $tutorial_lab_id;
	}
	
	public function get_points_possible()
	{
		return $this->points_possible;
	}

	public function set_points_possible($points_possible)
	{
		$this->points_possible = $points_possible;
	}
	
}

?>