<?php

class Assignment {
	
	private $assignment_id;
	private $professor_id;
	private $student_id;
	private $lab_id;	
	private $date_assigned;
	private $date_due;
	private $date_submited;
	private $total_time;	
	private $added_instructions;
	
	
	public function __construct() {}
	
	public function Assignment($assignment_id, $professor_id, $student_id, $lab_id, $date_assigne, $date_due, $date_submited, $total_time, $added_instructions)
	{
		$this->assignment_id = $assignment_id;
		$this->professor_id = $professor_id;
		$this->student_id = $student_id;
		$this->lab_id = $lab_id;	
		$this->date_assigned = $date_assigned;
		$this->date_due = $date_due;	
		$this->date_submited = $date_submited;
		$this->total_time = $total_time;
		$this->added_instructions = $added_instructions;
	}

	public function initialize($assignment_id, $professor_id, $student_id, $lab_id, $date_assigne, $date_due, $date_submited, $total_time, $added_instructions)
	{
		$this->assignment_id = $assignment_id;
		$this->professor_id = $professor_id;
		$this->student_id = $student_id;
		$this->lab_id = $lab_id;		
		$this->date_assigned = $date_assigned;
		$this->date_due = $date_due;	
		$this->date_submited = $date_submited;
		$this->total_time = $total_time;
		$this->added_instructions = $added_instructions;
	}
	
	public function get_assignment_id()
	{
		return $this->assignment_id;
	}

	public function set_assignment_id($assignment_id)
	{
		$this->assignment_id = $assignment_id;
	}
	
	public function get_professor_id()
	{
		return $this->professor_id;
	}

	public function set_professor_id($professor_id)
	{
		$this->professor_id = $professor_id;
	}
	
	public function get_student_id()
	{
		return $this->student_id;
	}

	public function set_student_id($student_id)
	{
		$this->student_id = $student_id;
	}
	
	public function get_lab_id()
	{
		return $this->lab_id;
	}

	public function set_lab_id($lab_id)
	{
		$this->lab_id = $lab_id;
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
	
	public function get_added_instructions()
	{
		return $this->added_instructions;
	}

	public function set_added_instructions($added_instructions)
	{
		$this->added_instructions = $added_instructions;
	}
	
}

?>