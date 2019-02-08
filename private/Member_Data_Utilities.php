<?php

class Member_Data_Utilities {
	
	public function __construct() {}

	
	// Gets the current section ids from the database for this student.
	// Then uses that information to get the sections from the database.
	public function get_sections_by_student($student_id, $mdb_control)
	{
		// a list of section id and student id pairs
		$student_sections = array();
		// a list of Section objects
		$section_list = array();
		$section_controller = $mdb_control->getController("section");
		$student_sections = $mdb_control->getController("section_student")->getByAttribute("student_id", $student_id);
		
		$num = count($student_sections);
		
		for($i = 0; $i < $num; $i++)
		{
			// get the section id for the next section for that student
			$section_id = $student_sections[$i]->get_section_id();
			$section = array();
			$section = $section_controller->getByAttribute("section_id", $section_id);
			// add sections to array
			$section_list = array_merge($section_list, $section);
		}
		
		return $section_list;
	}


	// Gets the current sections from the database for this professor.
	public function get_sections_by_professor($professor_id, $mdb_control)
	{
		$sections = array();
		$sections = $mdb_control->getController("section")->getByAttribute("professor_id", $professor_id);
		return $sections;
	}
	
	
	// Gets the current assignments from the database for the given list of sections.
	public function get_assignments_by_section($section_list, $mdb_control)
	{
		$assignment_list = array();		
		$assignment_controller = $mdb_control->getController("assignment");
		$num = count($section_list);
		
		for($i = 0; $i < $num; $i++)
		{
			// get the section id for the next section for that student
			$section_id = $section_list[$i]->get_section_id();
			$assignments = array();
			$assignments = $assignment_controller->getByAttribute("section_id", $section_id);
			// add new assignments to array
			$assignment_list = array_merge($assignment_list, $assignments);
		}
		
		return $assignment_list;
	}

	
	// Gets the current homeworks from the database for this assignment.
	public function get_homeworks_by_assignment($assignment_list, $mdb_control)
	{
		$homework_list = array();
		$homework_controller = $mdb_control->getController("homework");
		$num = count($assignment_list);
		
		for($i = 0; $i < $num; $i++)
		{
			// get the id for the next assignment
			$assignment_id = $assignment_list[$i]->get_assignment_id();
			$homeworks = array();
			$homeworks = $homework_controller->getByAttribute("assignment_id", $assignment_id);
			// add new homeworks to array
			$homework_list = array_merge($homework_list, $homeworks);
		}
		
		return $homework_list;
	}
	
	
	// Gets the current homeworks from the database for this student.
	public function get_homeworks_by_student($student_id, $mdb_control)
	{
		$homeworks = array();
		$hmwk_controller = $mdb_control->getController("homework");
		$homeworks = $hmwk_controller->getByAttribute("student_id", $student_id);
		return $homeworks;
	}
	
	
	// Gets the current homework submissions from the database for this student.
	public function get_submissions_by_student($student_id, $mdb_control)
	{
		$submissions = array();
		$submissions = $mdb_control->getController("homework_submission")->getByAttribute("student_id", $student_id);
		return $submissions;
	}
	
	
	// Gets the current homework submissions from the database for this assignment.
	public function get_submissions_by_assignment($assignment_list, $mdb_control)
	{
		$submission_list = array();
		$submission_controller = $mdb_control->getController("homework_submission");
		$num = count($assignment_list);
		
		for($i = 0; $i < $num; $i++)
		{
			// get the id for the next assignment
			$assignment_id = $assignment_list[$i]->get_assignment_id();
			$submissions = array();
			$submissions = $submission_controller->getByAttribute("assignment_id", $assignment_id);
			// add new submissions to array
			$submission_list = array_merge($submission_list, $submissions);
		}
		
		return $submission_list;
	}
	
	
	// Gets the current notices from the database sent by this student or professor.
	public function get_notices_by_member($member_id, $mdb_control)
	{
		$notices = array();
		$notices = $mdb_control->getController("notice")->getByAttribute("from_member_id", $member_id);
		return $notices;
	}
	
	
	// Gets the current notices from the database received by this section.
	public function get_notices_by_section($section_list, $mdb_control)
	{
		$notice_list = array();
		$notice_controller = $mdb_control->getController("notice");
		$num = count($section_list);
		
		for($i = 0; $i < $num; $i++)
		{
			// get the section id for the next section for that student
			$section_id = $section_list[$i]->get_section_id();
			$notices = array();
			$notices = $notice_controller->getByAttribute("to_section_id", $section_id);
			// add new notices to array
			$notice_list = array_merge($notice_list, $notices);
		}		
		
		return $notice_list;
	}

	
}

?>