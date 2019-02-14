<?php

class Homework_Submission {
	
	private $homework_id; 	// key
	private $student_id;		
	private $date_submitted;
	private $points_earned;
	private $was_graded;
	private $hours;
	
	public function __construct() {}
	
	public function initialize($assignment_id, $student_id, $date_submitted, $points_earned = 0, $was_graded = false, $hours = 0)
	{
		$this->assignment_id = $assignment_id;
		$this->student_id = $student_id;
		$this->date_submitted = $date_submitted;
		$this->points_earned = $points_earned;
		$this->hours = $hours;
		$this->was_graded = $was_graded;		
	}
	
	
	public function get_assignment_id()
	{
		return $this->assignment_id;
	}

	public function set_assignment_id($assignment_id)
	{
		$this->assignment_id = $assignment_id;
	}
	
	public function get_student_id()
	{
		return $this->student_id;
	}

	public function set_student_id($student_id)
	{
		$this->student_id = $student_id;
	}
	
	public function get_date_submitted()
	{
		return $this->date_submitted;
	}

	public function set_date_submitted($date_submitted)
	{
		$this->date_submitted = $date_submitted;
	}
	
	public function get_points_earned()
	{
		return $this->points_earned;
	}

	public function set_points_earned($points_earned)
	{
		$this->points_earned = $points_earned;
	}
	
	public function get_hours()
	{
		return $this->hours;
	}

	public function set_hours($hours)
	{
		$this->hours = $hours;
	}
	
	public function get_was_graded()
	{
		return $this->was_graded;
	}

	public function set_was_graded($was_graded)
	{
		$this->was_graded = $was_graded;
	}
	
	
}

?>