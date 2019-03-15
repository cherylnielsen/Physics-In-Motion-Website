<?php

class DisplayUtility
{	
	public function __construct() {}
	
	
	public function displayDateTime($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date_time = date("D, m/d/y g:i A", $time);
			return $formated_date_time;
		}		
		
		return null;
	}
	
	
	public function displayDateTimeLong($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date_time = date("D, M d, Y g:i A", $time);
			return $formated_date_time;
		}		
		
		return null;
	}
	
	
	public function displayDateLong($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date = date("D, M d, Y", $time);
			return $formated_date;
		}		
		
		return null;
	}
	
	
	public function displayDateShort($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date = date("D, m/d/y", $time);
			return $formated_date;
		}		
		
		return null;
	}
	
	
	public function getListSectionIDNames_ByProfessor($sectionDisplay, $professor_id, $mdb_control)
	{
		$sections = array();
		$section_names = array();
		$sections = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
		
		for($i = 0; $i < count($sections); $i++)
		{
			$sec_id = $sections[$i]->get_section_id();
			$sec_name = $sections[$i]->get_section_name();
			$section_names[$i]['id'] = "$sec_id"; 
			$section_names[$i]['name'] = "Section $sec_id : $sec_name"; 
		}
		
		return $section_names;
	}
	
	
	public function getListSectionIDNames_ByStudent($sectionDisplay, $student_id, $mdb_control)
	{
		$sections = array();
		$section_names = array();
		$sections = $sectionDisplay->getSectionList_ByStudent($student_id, $mdb_control);
		
		for($i = 0; $i < count($sections); $i++)
		{
			$sec_id = $sections[$i]->get_section_id();
			$sec_name = $sections[$i]->get_section_name();
			$section_names[$i]['id'] = "$sec_id"; 
			$section_names[$i]['name'] = "Section $sec_id : $sec_name"; 
		}
		
		return $section_names;
	}
	
	
	public function getListAdminIDNames($mdb_control)
	{
		$admins = array();
		$admin_names = array();
		$control = $mdb_control->getController("administrator_member_view");
		$admins = $control->getAllData();
		
		for($i = 0; $i < count($admins); $i++)
		{
			$admin_id = $admins[$i]->get_administrator_id();
			$first = $admins[$i]->get_first_name();
			$last = $admins[$i]->get_last_name();
			$admin_names[$i]['id'] = "$admin_id"; 
			$admin_names[$i]['name'] = "$first $last"; 
		}
		
		return $admin_names;
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
	
	
}
 
?>