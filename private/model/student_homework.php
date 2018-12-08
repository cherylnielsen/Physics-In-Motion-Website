<?php

class student_homework {
	
	private $assignment_id;
	private $student_id;
	private $lab_summary;
	private $lab_data;
	private $lab_graphs;
	private $lab_math;
	private $lab_errors;
	private $chat_session;
	private $lab_report;
	private $date_started;
	private $date_submited;
	private $total_time;
		
	public function student_homework() {}
	
	public function student_homework($assignment_id, $student_id)
	{
		$this->assignment_id $assignment_id;
		$this->student_id $student_id;
	}

	public function initialize($assignment_id, $student_id)
	{
		$this->assignment_id $assignment_id;
		$this->student_id $student_id;
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
	
	public function get_date_started()
	{
		return $this->date_started;
	}

	public function set_date_started($date_started)
	{
		$this->date_started = $date_started;
	}
	
	public function get_date_submited()
	{
		return $this->date_submited;
	}

	public function set_date_submited($date_submited)
	{
		$this->date_submited = $date_submited;
	}
	
	public function get_total_time()
	{
		return $this->total_time;
	}

	public function set_total_time($total_time)
	{
		$this->total_time = $total_time;
	}
	
	
}

?>