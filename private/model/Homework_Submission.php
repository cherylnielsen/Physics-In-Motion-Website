<?php

class Homework_Submission {
	
	private $assignment_id;
	private $student_id;
	private $date_submitted;
	private $points_earned;
	private $is_graded;
	private $total_time;
	
	public function __construct() {}
	
	public function initialize($assignment_id, $student_id, $date_submitted, $points_earned, $is_graded, $total_time)
	{
		$this->assignment_id = $assignment_id;
		$this->student_id = $student_id;
		$this->date_submitted = $date_submitted;
		$this->points_earned = $points_earned;
		$this->total_time = $total_time;
		
		// is_graded must be true or false 
		// this will set 0 to false and 1 to true
		// default value is false
		$this->set_is_graded($is_graded);
		
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
	
	public function get_total_time()
	{
		return $this->total_time;
	}

	public function set_total_time($total_time)
	{
		$this->total_time = $total_time;
	}
	
	public function get_is_graded()
	{
		return $this->is_graded;
	}

	/***
		is_graded must be true or false.
		This will set 0 to false and 1 to true.
		The default value is false.
	**/
	public function set_is_graded($is_graded)
	{
		if(!is_set($is_graded))
		{
			$this->is_graded = false;
		}
		else if(($is_graded == false) || ($is_graded == true))
		{
			$this->is_graded = $is_graded;
		}
		else if($is_graded == 0)
		{
			$this->is_graded = false;
		}
		else if($is_graded == 1)
		{
			$this->is_graded = true;
		}
		else
		{
			$this->is_graded = false;
		}
	}
	
	
}

?>