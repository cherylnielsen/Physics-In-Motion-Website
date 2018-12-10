<?php

class Homework {
	
	private $homework_id;
	private $assignment_id;
	private $lab_summary;
	private $lab_data;
	private $lab_graphs;
	private $lab_math;
	private $lab_errors;
	private $chat_session;
	private $lab_report;
		
		
	public function Homework() {}
	
	public function Homework($homework_id, $assignment_id, $lab_summary, $lab_data, $lab_graphs, $lab_math, $lab_errors, $chat_session, $lab_report)
	{
		$this->homework_id $homework_id;
		$this->assignment_id $assignment_id;
		$this->lab_summary $lab_summary;
		$this->lab_data $lab_data;
		$this->lab_graphs $lab_graphs;
		$this->lab_math $lab_math;
		$this->lab_errors $lab_errors;
		$this->chat_session $chat_session;
		$this->lab_report $lab_report;
	}
	
	public function initialize($homework_id, $lab_summary, $lab_data, $lab_graphs, $lab_math, $lab_errors, $chat_session, $lab_report)
	{
		$this->homework_id $homework_id;
		$this->assignment_id $assignment_id;
		$this->lab_summary $lab_summary;
		$this->lab_data $lab_data;
		$this->lab_graphs $lab_graphs;
		$this->lab_math $lab_math;
		$this->lab_errors $lab_errors;
		$this->chat_session $chat_session;
		$this->lab_report $lab_report;
	}
	
	
	public function get_homework_id()
	{
		return $this->homework_id;
	}

	public function set_homework_id($homework_id)
	{
		$this->homework_id = $homework_id;
	}
	
	public function get_assignment_id()
	{
		return $this->assignment_id;
	}

	public function set_assignment_id($assignment_id)
	{
		$this->assignment_id = $assignment_id;
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
	
	public function get_lab_graphs()
	{
		return $this->lab_graphs;
	}

	public function set_lab_graphs($lab_graphs)
	{
		$this->lab_graphs = $lab_graphs;
	}
	
	public function get_lab_math()
	{
		return $this->lab_math;
	}

	public function set_lab_math($lab_math)
	{
		$this->lab_math = $lab_math;
	}

	public function get_lab_errors()
	{
		return $this->lab_errors;
	}

	public function set_lab_errors($lab_errors)
	{
		$this->lab_errors = $lab_errors;
	}
	
	public function get_chat_session()
	{
		return $this->chat_session;
	}

	public function set_chat_session($chat_session)
	{
		$this->chat_session = $chat_session;
	}

	public function get_lab_report()
	{
		return $this->lab_report;
	}

	public function set_lab_report($lab_report)
	{
		$this->lab_report = $lab_report;
	}	
	
}

?>