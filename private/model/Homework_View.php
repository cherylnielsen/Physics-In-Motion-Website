<?php


class Homework_View extends Homework {
	
	public function __construct() {}
	
	public function initializeView($homework_id, $section_id, $assignment_id, $student_id, 
								$lab_summary, $lab_data, $graphs, $math, $hints, $chat_session,
								$date_submitted, $points_earned = 0, $was_graded = false, $hours = 0, $student_first_name, $student_last_name, $school_name)
	{
		$this->initialize($homework_id, $section_id, $assignment_id, $student_id, 
								$lab_summary, $lab_data, $graphs, $math, $hints, $chat_session,
								$date_submitted, $points_earned = 0, $was_graded = false, $hours = 0);
								
		$this->student_first_name = $student_first_name;
		$this->student_last_name = $student_last_name;
		$this->school_name = $school_name;
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
	
}

?>