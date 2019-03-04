<?php


class Homework {
	
	protected $homework_id; // key 
	protected $section_id;
	protected $assignment_id; 
	protected $student_id;		
	// the homework produced
	protected $lab_summary;
	protected $lab_data;
	protected $graphs;
	protected $math;
	protected $hints;
	protected $chat_session;	
	// the homework submitted
	protected $date_submitted;
	protected $points_earned;
	protected $was_graded;
	protected $hours;
			
	public function __construct() {}
	
	public function initialize($homework_id, $section_id, $assignment_id, $student_id, 
								$lab_summary, $lab_data, $graphs, $math, $hints, $chat_session,
								$date_submitted, $points_earned = 0, $was_graded = false, $hours = 0)
	{
		$this->homework_id = $homework_id;
		$this->section_id = $section_id;
		$this->assignment_id = $assignment_id;
		$this->student_id = $student_id;
		$this->lab_summary = $lab_summary;
		$this->lab_data = $lab_data;
		$this->graphs = $graphs;
		$this->math = $math;
		$this->hints = $hints;
		$this->chat_session = $chat_session;
		$this->date_submitted = $date_submitted;
		$this->points_earned = $points_earned;
		$this->hours = $hours;
		$this->was_graded = $was_graded;	
	}
	
	public function get_homework_id()
	{
		return $this->homework_id;
	}

	public function set_homework_id($homework_id)
	{
		$this->homework_id = $homework_id;
	}
	
	public function get_section_id()
	{
		return $this->section_id;
	}

	public function set_section_id($section_id)
	{
		$this->section_id = $section_id;
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
	
	public function get_lab_summary()
	{
		return $this->lab_summary;
	}

	public function set_lab_summary($lab_summary)
	{
		$this->lab_summary = $lab_summary;
	}
	
	public function get_lab_data()
	{
		return $this->lab_data;
	}

	public function set_lab_data($lab_data)
	{
		$this->lab_data = $lab_data;
	}
	
	public function get_graphs()
	{
		return $this->graphs;
	}

	public function set_graphs($graphs)
	{
		$this->graphs = $graphs;
	}
	
	public function get_math()
	{
		return $this->math;
	}

	public function set_math($math)
	{
		$this->math = $math;
	}

	public function get_hints()
	{
		return $this->hints;
	}

	public function set_hints($hints)
	{
		$this->hints = $hints;
	}
	
	public function get_chat_session()
	{
		return $this->chat_session;
	}

	public function set_chat_session($chat_session)
	{
		$this->chat_session = $chat_session;
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