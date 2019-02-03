<?php

class MemberDataUtilities {
	
	public function __construct() {}

	
	// Gets the current section memberships from the database for this student.
	public function get_student_sections($student_id)
	{
		sections = array();
		$sections = $mdb_control->getController("section-students")->getByAttribute("student_id", $student_id);
		return $sections;
	}


	// Gets the current section memberships from the database for this professor.
	public function get_professor_sections($professor_id)
	{
		sections = array();
		$sections = $mdb_control->getController("section_professors")->getByAttribute("professor_id", $professor_id);
		return $sections;
	}
	
	
	// Gets the current assignments from the database for this section.
	public function get_section_assignments($section_id)
	{
		$assignments = array();		
		$assignments = $mdb_control->getController("assignment")->getByAttribute("section_id", $section_id);
		return $assignments;
	}
	
	
	// Gets the current homeworks from the database for this assignment and student.
	public function get_assignment_homework($student_id, $assignment_id)
	{
		$homeworks = array();
		$homeworks = $mdb_control->getController("homework")->getByAttributes("student_id", $student_id, "assignment_id", $assignment_id);
		return $homeworks;
	}

	
	// Gets the current homework submissions from the database for this assignment and student.
	public function get_homework_submissions($student_id, $assignment_id)
	{
		$homeworks = array();
		$sections = $mdb_control->getController("homework_submission")->getByAttributes("student_id", $student_id, "assignment_id", $assignment_id);
		return $user_id;
	}
	
	
	// Gets the current notices from the database for this student or professor.
	public function get_notices_sent($user_id)
	{
		$notices = array();
		$sections = $mdb_control->getController("notice")->getByAttribute("from_user_id", $user_id);
		
		return $notices;
	}
	
	
	// Gets the current notices from the database for this student or professor.
	public function get_notices_received($user_id)
	{
		$notices = array();
		$sections = $mdb_control->getController("notice")->getByAttribute("to_user_id", $user_id);
		
		return $notices;
	}

	
}

?>