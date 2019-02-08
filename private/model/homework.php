<?php

class Homework {
	
	private $student_id;		// key part 1
	private $assignment_id; 	// key part 2
	private $lab_summary;
	private $lab_data;
	private $graphs;
	private $math;
	private $hints;
	private $chat_session;		
	
	private $has_lab_summary;
	private $has_lab_data;
	private $has_graphs;
	private $has_math;
	private $has_hints;
	private $has_chat_session;
	
		
	public function __construct() {}
	
	public function initialize($assignment_id, $student_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)
	{
		$this->assignment_id = $assignment_id;
		$this->student_id = $student_id;
		$this->lab_summary = $lab_summary;
		$this->lab_data = $lab_data;
		$this->graphs = $graphs;
		$this->math = $math;
		$this->hints = $hints;
		$this->chat_session = $chat_session;
		
		$this->has_lab_summary = isset($lab_summary);
		$this->has_lab_data = isset($lab_data);
		$this->has_graphs = isset($graphs);
		$this->has_math = isset($math);
		$this->has_hints = isset($hints);
		$this->has_chat_session = isset($chat_session);
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

	
	public function get_has_lab_summary()
	{
		return $this->has_lab_summary;
	}

	public function set_has_lab_summary($has_lab_summary)
	{
		$this->has_lab_summary = $has_lab_summary;
	}
	
	public function get_has_lab_data()
	{
		return $this->has_lab_data;
	}

	public function set_has_lab_data($has_lab_data)
	{
		$this->has_lab_data = $has_lab_data;
	}
	
	public function get_has_graphs()
	{
		return $this->has_graphs;
	}

	public function set_has_graphs($has_graphs)
	{
		$this->has_graphs = $has_graphs;
	}
	
	public function get_has_math()
	{
		return $this->has_math;
	}

	public function set_has_math($has_math)
	{
		$this->has_math = $has_math;
	}

	public function get_has_hints()
	{
		return $this->has_hints;
	}

	public function set_has_hints($has_hints)
	{
		$this->has_hints = $has_hints;
	}
	
	public function get_has_chat_session()
	{
		return $this->has_chat_session;
	}

	public function set_has_chat_session($has_chat_session)
	{
		$this->has_chat_session = $has_chat_session;
	}
	
}

?>