<?php

class MemberDataUtility
{	
	public function __construct() {}
	
	
	public function getMemberList($mdb_control)
	{
		$admin_list = array();
		$admin_list = $this->getListAdministratorIDName($mdb_control);
		
		$professor_list = array();
		$professor_list = $this->getListProfessorIDName($mdb_control);
		
		$student_list = array();
		$student_list = $this->getListStudentIDName($mdb_control);
		
		$member_list = array();
		$member_list = array_merge($admin_list, $professor_list, $student_list);
		
		return $member_list;
	}
	
	
	public function getListAdministratorIDName($mdb_control)
	{
		$member_list = array();		
		$member_view = array();
		
		$control = $mdb_control->getController("administrator_member_view");
		$member_view = $control->getAllData();
				
		for($i = 0; $i < count($member_view); $i++)
		{
			$member_list[$i]['id'] = $member_view[$i]->get_administrator_id();
			$member_list[$i]['type'] = "administrator";
			$first = $member_view[$i]->get_first_name();
			$last = $member_view[$i]->get_last_name();
			$member_list[$i]['name'] = "$first $last"; 
		}

		return $member_list;
	}
	
	
	public function getListProfessorIDName($mdb_control)
	{	
		$member_list = array();
		$member_view = array();
		
		$control = $mdb_control->getController("professor_member_view");
		$member_view = $control->getAllData();
		
		for($i = 0; $i < count($member_view); $i++)
		{
			$member_list[$i]['id'] = $member_view[$i]->get_professor_id();
			$member_list[$i]['type'] = "professor";
			$first = $member_view[$i]->get_first_name();
			$last = $member_view[$i]->get_last_name();
			$member_list[$i]['name'] = "$first $last"; 
		}

		return $member_list;
	}
	
	
	public function getListStudentIDName($mdb_control)
	{
		$member_list = array();
		$member_view = array();
		
		$control = $mdb_control->getController("student_member_view");
		$member_view = $control->getAllData();		
		
		for($i = 0; $i < count($member_view); $i++)
		{
			$member_list[$i]['id'] = $member_view[$i]->get_student_id();
			$member_list[$i]['type'] = "student";
			$first = $member_view[$i]->get_first_name();
			$last = $member_view[$i]->get_last_name();
			$member_list[$i]['name'] = "$first $last"; 
		}
		
		return $member_list;
	}

	
	public function getListTutorialLabIDNames($mdb_control)
	{
		$labs = array();
		$labs = $mdb_control->getController("tutorial_lab")->getAllData();
		$tutorial_lab_list = array();
		
		for($i = 0; $i < count($labs); $i++)
		{
			$lab_id = $labs[$i]->get_tutorial_lab_id();
			$lab_name = $labs[$i]->get_tutorial_lab_name();
			$tutorial_lab_list[$i]['name'] = "Tutorial Lab " . $lab_id . " : " . $lab_name;
			$tutorial_lab_list[$i]['id'] = $lab_id;
		}
		
		return $tutorial_lab_list;
	}
	
	
	public function getListTutorialLabIDNames_ByStudent($sectionTables, $student_id, $mdb_control)
	{
		$section_list = array();
		$assignment_list = array();
		$tutorial_lab_names = array();
		
		$section_list = $sectionTables->getSectionList_ByStudent($student_id, $mdb_control);
						
		for($i = 0; $i < count($section_list); $i++)
		{
			$section_id = $section_list[$i]->get_section_id();
			$assignment_list = array();
			$controller = $mdb_control->getController("assignment_view");
			$assignment_list = $controller->getByAttribute("section_id", $section_id);
			
			for($j = 0; $j < count($assignment_list); $j++)
			{
				$lab_id = $assignment_list[$j]->get_tutorial_lab_id();
				$lab_name = $assignment_list[$j]->get_tutorial_lab_name();
				$tutorial_lab_names[$j]['name'] = "Tutorial Lab " . $lab_id . " : " . $lab_name;
				$tutorial_lab_names[$j]['id'] = $lab_id;
			}
		}

		return $tutorial_lab_names;
	}
	
	
	
}

?>