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
	public function get_submissions_by_homework($homework_list, $mdb_control)
	{
		$submission_list = array();
		$submission_controller = $mdb_control->getController("homework_submission");
		$num = count($homework_list);
		
		for($i = 0; $i < $num; $i++)
		{
			// get the id for the next assignment
			$homework_id = $homework_list[$i]->get_assignment_id();
			$submissions = array();
			$submissions = $submission_controller->getByAttribute("homework_id", $homework_id);
			// add new submissions to array
			$submission_list = array_merge($submission_list, $submissions);
		}
		
		return $submission_list;
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
	
	
	// Gets the current notices from the database sent by this member.
	public function get_notices_sent_by_member($member_id, $mdb_control)
	{
		$notices = array();
		$sent_to_sections = array();
		$attachments = array();
		$sent_to_members = array();
		$num = 0;
		
		$notices = $mdb_control->getController("notice")->getByAttribute("from_member_id", $member_id);
		$num = count($notices);
		
		for($i = 0; $i < $num; $i++)
		{
			$notice_id = $notices[$i]->get_notice_id();
			$sent_to_sections = $mdb_control->getController("notice_to_section")->getByAttribute("notice_id", $notice_id);
			$notices[$i]->set_sent_to_sections($sent_to_sections);
			$sent_to_members = $mdb_control->getController("notice_to_member")->getByAttribute("notice_id", $notice_id);
			$notices[$i]->set_sent_to_members($sent_to_members);
			$attachments = $mdb_control->getController("notice_attachment")->getByAttribute("notice_id", $notice_id);
			$notices[$i]->set_attachments($attachments);			
		}
		
		return $notices;
	}
	
	
	// Gets the current notices from the database received by this section.
	public function get_notices_received_by_section($section_list, $mdb_control)
	{
		$notice_list = array();
		$notices_sent_to_section = array();
		$sent_to_sections = array();
		$attachments = array();
		$sent_to_members = array();
		$num_sections = 0;
		$num_sent = 0;
		
		$num_sections = count($section_list);
		
		for($i = 0; $i < $num_sections; $i++)
		{
			$section_id = $section_list[$i]->get_section_id();
			$list_by_notice_id = $mdb_control->getController("notice_to_section")->getByAttribute("to_section_id", $section_id);
			$num_sent_to_section = count($list_by_notice_id);
			$notices = array();
						
			for($j = 0; $j < $num_sent_to_section; $j++)
			{
				$notice_id = $list_by_notice_id[$i]->get_notice_id();
				$notices = $mdb_control->getController("notice")->getByAttribute("notice_id", $notice_id);
				$notice = new Notice();
				$notice = $notices[0];
				
				$sent_to_sections = $mdb_control->getController("notice_to_section")->getByAttribute("notice_id", $notice_id);
				$notice->set_sent_to_sections($sent_to_sections);
				$sent_to_members = $mdb_control->getController("notice_to_member")->getByAttribute("notice_id", $notice_id);
				$notice->set_sent_to_members($sent_to_members);
				$attachments = $mdb_control->getController("notice_attachment")->getByAttribute("notice_id", $notice_id);
				$notice->set_attachments($attachments);	
				
				// add notice to end of the array
				$notice_list[] = $notice;
			}			
		}		
		
		return $notice_list;
	}


	// Gets the current notices from the database received by this member.
	public function get_notices_received_by_member($member_id, $mdb_control)
	{
		$notice_list = array();
		$notice_controller = $mdb_control->getController("notice");
		$notice_to_member_controller = $mdb_control->getController("notice_to_member");
		$num = count($section_list);
		
		for($i = 0; $i < $num; $i++)
		{
			// get the section id for the next section for that student
			$section_id = $section_list[$i]->get_member_id();
			$notices = array(); 
			$notices = $notice_controller->getByAttribute("to_member_id", $member_id);
			// add new notices to array
			$notice_list = array_merge($notice_list, $notices);
		}		
		
		return $notice_list;
	}
	
	
}

?>