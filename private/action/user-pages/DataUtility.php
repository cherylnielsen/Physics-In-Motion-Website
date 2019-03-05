<?php

class DataUtility {
	
	public function __construct() {}

	
	// Gets the list of all students in this section.
	public function getSectionListOfStudents($section_id, $mdb_control)
	{
		$student_list = array();
		$controller = $mdb_control->getController("section_students_view");
		$student_list = $controller->getByAttribute("section_id", $section_id);
		
		return $student_list;
	}


	// Gets the current sections from the database for this student.
	public function getSectionList_ByStudent($student_id, $mdb_control)
	{
		$section_list = array();
		$student_sections = array();
		$controller = $mdb_control->getController("section_student");
		$student_sections = $controller->getByAttribute("student_id", $student_id);
		$num = count($student_sections);
		
		$controller = $mdb_control->getController("section_view");
				
		for($i = 0; $i < $num; $i++)
		{
			$section_id = $student_sections[$i]->get_section_id();
			$section = array();
			$section = $controller->getByAttribute("section_id", $section_id);
			
			if(count($section) == 1)
			{
				$section_list[] = $section[0];
			}
		}
		
		return $section_list;
	}
	
	
	// Gets the current sections from the database for this professor.
	public function getSectionList_ByProfessor($professor_id, $mdb_control)
	{
		$sections = array();
		$controller = $mdb_control->getController("section_view");
		$sections = $controller->getByAttribute("professor_id", $professor_id);
		return $sections;
	}

	
	// Gets all assignments from the database for this section.
	public function getSectionAssignments($section_id, $mdb_control)
	{
		$assignment_list = array();
		$controller = $mdb_control->getController("assignment_view");
		$assignment_list = $controller->getByAttribute("section_id", $section_id);
		
		return $assignment_list;
	}	
	
	
	// Gets all homeworks from the database for this assignment in this section for all students.
	public function getSectionHomework_ByAssignment($assignment_id, $section_id, $mdb_control)
	{
		$homework_list = array();
		$controller = $mdb_control->getController("homework");
		$homework_list = $controller->getByAttributes("assignment_id", $assignment_id, "section_id", $section_id);
		
		return $homework_list;
	}
	
	
	// Gets all homeworks from the database for this student in this section for all assignments.
	public function getSectionHomework_ByStudent($student_id, $section_id, $mdb_control)
	{
		$homework_list = array();
		$controller = $mdb_control->getController("homework");
		$homework_list = $controller->getByAttributes("student_id", $student_id, "section_id", $section_id);
		
		return $homework_list;
	}
	
	
	// Gets all notices from the database sent by this member.
	public function getMemberSentNotices($from_member_id, $mdb_control)
	{
		$notice_list = array();		
		$controller = $mdb_control->getController("notice_view");
		$notice_list = $controller->getByAttribute("from_member_id", $from_member_id);
		
		return $notice_list;
	}
	
	
	// Gets all notices from the database sent to this member.
	public function getMemberInBoxNotices($to_member_id, $mdb_control)
	{
		$notices_to_member = array();		
		$controller = $mdb_control->getController("notice_to_member");
		$notices_to_member = $controller->getByAttribute("to_member_id", $to_member_id);
		
		$num_notices = count($notices_to_member);
		$notice_list = array();	
		$controller = $mdb_control->getController("notice_view");
		
		for($i = 0; $i < $num_notices; $i++)
		{
			$notice_id = $notices_to_member[$i]->get_notice_id();
			$notice = array();
			$notice = $controller->getByAttribute("notice_id", $notice_id);
			
			if(count($notice) == 1)
			{
				$notice_list[] = $notice[0];
			}
		}
		
		return $notice_list;
	}


	// Gets all notices from the database received by this section.
	public function getSectionNotices($to_section_id, $mdb_control)
	{
		$notices_to_section = array();		
		$controller = $mdb_control->getController("notice_to_section");
		$notices_to_section = $controller->getByAttribute("to_section_id", $to_section_id);
		
		$num_notices = count($notices_to_section);
		$notice_list = array();	
		$controller = $mdb_control->getController("notice_view");
		
		for($i = 0; $i < $num_notices; $i++)
		{
			$notice_id = $notices_to_section[$i]->get_notice_id();
			$notice = array();
			$notice = $controller->getByAttribute("notice_id", $notice_id);
			
			if(count($notice) == 1)
			{
				$notice_list[] = $notice[0];
			}
		}
		
		return $notice_list;
	}
	
	
	// tests if a notice is sent to a section instead of being sent to a member
	public function isNoticeToSection($notice_id, $mdb_control)
	{
		$notices_to_section = array();		
		$controller = $mdb_control->getController("notice_to_section");
		$notices_to_section = $controller->getByAttribute("notice_id", $notice_id);
		
		$num_notices = count($notices_to_section);
		$is_to_section = ($num_notices >= 1 ? true : false);
		
		return $is_to_section;
	}
	
	
	// Gets all attachments from the database for this notice id.
	public function getNoticeAttachments($notice_id, $mdb_control)
	{
		$attachment_list = array();
		$controller = $mdb_control->getController("notice_attachment");
		$attachment_list = $controller->getByAttribute("notice_id", $notice_id);
		
		return $attachment_list;
	}
	
	
}

?>