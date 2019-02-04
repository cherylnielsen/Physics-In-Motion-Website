<?php

class MemberDataUtilities {
	
	public function __construct() {}

	
	// Gets the current section memberships from the database for this student.
	public function get_sections_by_student($student_id)
	{
		sections = array();
		$sections = $mdb_control->getController("section-students")->getByAttribute("student_id", $student_id);
		return $sections;
	}


	// Gets the current section memberships from the database for this professor.
	public function get_sections_by_professor($professor_id)
	{
		sections = array();
		$sections = $mdb_control->getController("section_professors")->getByAttribute("professor_id", $professor_id);
		return $sections;
	}
	
	
	// Gets the current assignments from the database for this section.
	public function get_assignments_by_section($section_id)
	{
		$assignments = array();		
		$assignments = $mdb_control->getController("assignment")->getByAttribute("section_id", $section_id);
		return $assignments;
	}
	
	
	// Gets the current homeworks from the database for this student.
	public function get_homeworks_by_student($student_id)
	{
		$homeworks = array();
		$homeworks = $mdb_control->getController("homework")->getByAttribute("student_id", $student_id);
		return $homeworks;
	}

	
	// Gets the current homeworks from the database for this assignment.
	public function get_homeworks_by_assignment($assignment_id)
	{
		$homeworks = array();
		$homeworks = $mdb_control->getController("homework")->getByAttribute("assignment_id", $assignment_id);
		return $homeworks;
	}
	
	
	// Gets the current homework submissions from the database for this student.
	public function get_submissions_by_student($student_id)
	{
		$submissions = array();
		$sections = $mdb_control->getController("homework_submission")->getByAttribute("student_id", $student_id);
		return $submissions;
	}
	
	
	// Gets the current homework submissions from the database for this assignment.
	public function get_submissions_by_assignment($assignment_id)
	{
		$submissions = array();
		$sections = $mdb_control->getController("homework_submission")->getByAttribute("assignment_id", $assignment_id);
		return $submissions;
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