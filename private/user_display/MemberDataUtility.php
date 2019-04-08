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

	
	
	
}

?>