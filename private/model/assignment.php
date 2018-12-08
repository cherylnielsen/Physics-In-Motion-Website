<?php

class assignment {
	
	private $assignment_id;
	private $professor_id;
	private $student_id;
	private $lab_id;
	private $grade_points;
	private $date_assigned;
	private $date_due;
	private $added_instructions;
	
	public function assignment() {}
	
	public function assignment($assignment_id, $professor_id, $student_id, $lab_id, $grade_points, $date_assigned, $date_due, $added_instructions)
	{
		$this->assignment_id = $assignment_id;
		$this->professor_id = $professor_id;
		$this->student_id = $student_id;
		$this->lab_id = $lab_id;
		$this->grade_points = $grade_points;
		$this->date_assigned = $date_assigned;
		$this->date_due = $date_due;
		$this->added_instructions = $added_instructions;
	}

	public function initialize($assignment_id, $professor_id, $student_id, $lab_id, $grade_points, $date_assigned, $date_due, $added_instructions)
	{
		$this->assignment_id = $assignment_id;
		$this->professor_id = $professor_id;
		$this->student_id = $student_id;
		$this->lab_id = $lab_id;
		$this->grade_points = $grade_points;
		$this->date_assigned = $date_assigned;
		$this->date_due = $date_due;
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
		
	public function get_grade_points()
	{
		return $this->grade_points;
	}

	public function set_grade_points($grade_points)
	{
		$this->grade_points = $grade_points;
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