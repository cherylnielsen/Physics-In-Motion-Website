<?php

class SectionTables
{
	
	public function __construct() 
	{
	}
	
		
	public function getSectionWelcome($section_id, $mdb_control)
	{
		$controller = $mdb_control->getController("section_view");
		$section = $controller->getByPrimaryKey("section_id", $section_id);
		$section_name = $section->get_section_name();
		$school_name = $section->get_school_name();		
		$date_time = $section->get_start_date();
		$start_date = date("D, M d, Y", strtotime($date_time));
		$date_time = $section->get_end_date();
		$end_date = date("D, M d, Y", strtotime($date_time));

		$welcome = "<h1 class='welcome'>$school_name | Section $section_id : 
				$section_name | from $start_date to $end_date</h1>";
				
		return $welcome;
	}
	
	
	public function displaySectionMembershipTable($section_list, $mdb_control, $member_type)
	{
		echo "<table class='summary'>
				<caption>Click on a section to view.</caption>
				<tr><th colspan='10'><h2>Section Memberships</h2></th></tr>";
				
		$num_sections = count($section_list);
		
		if($num_sections <= 0)
		{
			echo "<tr><td colspan='10'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th><th>Status</th></tr>
					";
			
			for($i = 0; $i < $num_sections; $i++)
			{			
				$section_id = $section_list[$i]->get_section_id();
				$tableRow = $this->sectionMembershipRow($section_list[$i], 
											$member_type, $mdb_control);
				
				echo "<tr>$tableRow</tr>";
			}
		}
		
		echo "</table>";
	}
	
	
	public function sectionMembershipRow($section_view, $member_type, $mdb_control)
	{
		$section_id = $section_view->get_section_id();
		$section_name = $section_view->get_section_name();
		$first_name = $section_view->get_professor_first_name();
		$last_name = $section_view->get_professor_last_name();
		$school_name = $section_view->get_school_name();
		
		$date_time = $section_view->get_start_date();
		$start_date = date("D, M d, Y", strtotime($date_time));		
		$date_time = $section_view->get_end_date();
		$end_date = date("D, M d, Y", strtotime($date_time));
		
		$link = "";	
		$dropped_section = false;
				
		switch ($member_type)
		{
			case "student":
				$student_id = $_SESSION['student_id'];
				$link = "<a href='student-home-page.php?section_id=$section_id'>";
				
				$controller = $mdb_control->getController("section_student");
				$section_student = $controller->getByPrimaryKeys(
											"section_id", $section_id, "student_id", $student_id);
				$dropped_section = $section_student->get_dropped_section();
				break;
				
			case "professor":
				$link = "<a href='professor-home-page.php?section_id=$section_id'>";
				break;
		}
		
		$today = new DateTime("now");
		$end = new DateTime($end_date);
		$start = new DateTime($start_date);
		
		$status = " ";		
		if($dropped_section) { $status = "Dropped"; }
			else if($end < $today) { $status = "Completed"; }
				else if($today < $start) { $status = "To Be Done"; }
					else if(($start <= $today) && ($today <= $end))
							{ $status = "In Progress"; }
			
		
		$row = "<td>$link" . "Section $section_id&nbsp;:&nbsp;$section_name</a></td>		
				<td>$first_name&nbsp;&nbsp;$last_name</td> 
				<td>$school_name</td>
				<td>$start_date</td><td>$end_date</td>
				<td>$status</td>";
		
		return $row;
	}
	
	
	
	public function getSectionShortList($section_list, $mdb_control, $member_type)
	{			
		$num_sections = count($section_list);
		$short_list = array();
		
		if($num_sections <= 0)
		{
			return $short_list;
		}		
		
		for($i = 0; $i < $num_sections; $i++)
		{	
			$section_id = $section_list[$i]->get_section_id();
			$section_name = $section_list[$i]->get_section_name();
			$today = new DateTime("now");
			
			$date_time = $section_list[$i]->get_start_date();
			$start_date = date("D, M d, Y", strtotime($date_time));
			$start = new DateTime($start_date);
			
			$date_time = $section_list[$i]->get_end_date();
			$end_date = date("D, M d, Y", strtotime($date_time));
			$end = new DateTime($end_date);		
			$dropped_section = false;
					
			if($member_type == "student")
			{						
				$student_id = $_SESSION['student_id'];
				$controller = $mdb_control->getController("section_student");
				$section_student = $controller->getByPrimaryKeys(
									"section_id", $section_id, "student_id", $student_id);
				$dropped_section = $section_student->get_dropped_section();
			}
			
			if((!$dropped_section) && ($start <= $today) && ($today <= $end))
			{
				$short_list[$i]['id'] = $section_id;
				$short_list[$i]['name'] = $section_name;
			}			
		}
		
			return $short_list;	
			
	}
	
	
	// Gets the current sections from the database for this professor.
	public function getSectionList_ByProfessor($professor_id, $mdb_control)
	{
		$sections = array();
		$controller = $mdb_control->getController("section_view");
		$sections = $controller->getByAttribute("professor_id", $professor_id);
		return $sections;
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
	
	
	public function getListSectionIDNames_ByProfessor($professor_id, $mdb_control)
	{
		$sections = array();
		$section_names = array();
		$sections = $this->getSectionList_ByProfessor($professor_id, $mdb_control);
		
		for($i = 0; $i < count($sections); $i++)
		{
			$sec_id = $sections[$i]->get_section_id();
			$sec_name = $sections[$i]->get_section_name();
			$section_names[$i]['id'] = "$sec_id"; 
			$section_names[$i]['name'] = "Section $sec_id : $sec_name"; 
		}
		
		return $section_names;
	}
	
	
	public function getListSectionIDNames_ByStudent($student_id, $mdb_control)
	{
		$sections = array();
		$section_names = array();
		$sections = $this->getSectionList_ByStudent($student_id, $mdb_control);
		
		for($i = 0; $i < count($sections); $i++)
		{
			$sec_id = $sections[$i]->get_section_id();
			$sec_name = $sections[$i]->get_section_name();
			$section_names[$i]['id'] = "$sec_id"; 
			$section_names[$i]['name'] = "Section $sec_id : $sec_name"; 
		}
		
		return $section_names;
	}

	
	public function getListSectionIDNames_All($mdb_control)
	{
		$sections = array();
		$section_names = array();
		$sections = $mdb_control->getController("tutorial_lab")->getAllData();
		
		for($i = 0; $i < count($sections); $i++)
		{
			$sec_id = $sections[$i]->get_section_id();
			$sec_name = $sections[$i]->get_section_name();
			$section_names[$i]['id'] = "$sec_id"; 
			$section_names[$i]['name'] = "Section $sec_id : $sec_name"; 
		}
		
		return $section_names;
	}

	
	public function getSectionList($mdb_control)
	{
		$sectionList = "";
		
		switch($_SESSION['member_type'])
		{
			case "professor":
				$sectionList = $this->getListSectionIDNames_ByProfessor(
										$_SESSION['professor_id'], $mdb_control);	
				break;
			case "student":
				$sectionList = $this->getListSectionIDNames_ByStudent(
										$_SESSION['student_id'], $mdb_control);
				break;
			case "administrator":
				$sectionList = $this->getListSectionIDNames_All($mdb_control);
				break;
		}
			
		return $sectionList;
		
	}
	
	
	
	
	
}

 
?>