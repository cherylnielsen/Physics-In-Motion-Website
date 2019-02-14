<?php

class Homework {
	
	private $homework_id; // key 
	private $student_id;		
	private $assignment_id; 	
	private $lab_summary;
	private $lab_data;
	private $graphs;
	private $math;
	private $hints;
	private $chat_session;	
	private $homework_submition;
		
	public function __construct() {}
	
	public function initialize($assignment_id, $student_id, $lab_summary, $lab_data, 
								$graphs, $math, $hints, $chat_session, $homework_submition)
	{
		$this->assignment_id = $assignment_id;
		$this->student_id = $student_id;
		$this->lab_summary = $lab_summary;
		$this->lab_data = $lab_data;
		$this->graphs = $graphs;
		$this->math = $math;
		$this->hints = $hints;
		$this->chat_session = $chat_session;
		$this->homework_submition = $homework_submition;
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
	
	public function get_added_instructions()
	{
		return $this->added_instructions;
	}

	public function set_added_instructions($added_instructions)
	{
		$this->added_instructions = $added_instructions;
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

	public function get_homework_submition()
	{
		return $this->homework_submition;
	}

	public function set_homework_submition($homework_submition)
	{
		$this->homework_submition = $homework_submition;
	}
	
	
}

?>