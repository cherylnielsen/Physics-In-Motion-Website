<?php

class SectionDisplay
{
	private $displayUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
	}
	
	
	public function displaySectionWelcome($section_id, $mdb_control)
	{
		$controller = $mdb_control->getController("section_view");
		$section = $controller->getByPrimaryKey("section_id", $section_id);
		$section_name = $section->get_section_name();
		$school_name = $section->get_school_name();		
		$date_time = $section->get_start_date();
		$start_date = $this->displayUtility->displayDateLong($date_time);
		$date_time = $section->get_end_date();
		$end_date = $this->displayUtility->displayDateLong($date_time);

		echo "<h2 class=welcome>$school_name | Section $section_id : 
				$section_name | from $start_date to $end_date</h2>";
	}
	
	
	public function sectionMembershipRow($section_view, $member_type, $mdb_control)
	{
		$section_id = $section_view->get_section_id();
		$section_name = $section_view->get_section_name();
		$first_name = $section_view->get_professor_first_name();
		$last_name = $section_view->get_professor_last_name();
		$school_name = $section_view->get_school_name();
		
		$date_time = $section_view->get_start_date();
		$start_date = $this->displayUtility->displayDateLong($date_time);		
		$date_time = $section_view->get_end_date();
		$end_date = $this->displayUtility->displayDateLong($date_time);
		
		$link = "";	
		$dropped_section = false;
				
		switch ($member_type)
		{
			case "student":
				$student_id = $_SESSION['student_id'];
				$link = "<a href='student-section-page.php?section_id=$section_id'>";
				
				$controller = $mdb_control->getController("section_student");
				$section_student = $controller->getByPrimaryKeys(
											"section_id", $section_id, "student_id", $student_id);
				$dropped_section = $section_student->get_dropped_section();
				break;
				
			case "professor":
				$link = "<a href='professor-section-page.php?section_id=$section_id'>";
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
			
		
		$row = "<td>$link" . "Section $section_id&nbsp:&nbsp$section_name</a></td>		
				<td>$first_name&nbsp&nbsp$last_name</td> 
				<td>$school_name</td>
				<td>$start_date</td><td>$end_date</td>
				<td>$status</td>";
		
		return $row;
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
					<th>Start Date</th><th>End Date</th><th>Status</th></tr>";
			
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
	
	
	public function displaySectionShortList($section_list, $mdb_control, $member_type)
	{			
		$num_sections = count($section_list);
		$num_listed = 0;
		$link = "";
		
		if($num_sections <= 0)
		{
			echo "<p class='navigation'>No current sections</p>";
			return;
		}		
		
		if($member_type == "student")
		{			
			for($i = 0; $i < $num_sections; $i++)
			{	
				$section_id = $section_list[$i]->get_section_id();
				$section_name = $section_list[$i]->get_section_name();
				
				$student_id = $_SESSION['student_id'];
				$controller = $mdb_control->getController("section_student");
				$section_student = $controller->getByPrimaryKeys(
									"section_id", $section_id, "student_id", $student_id);
				$dropped_section = $section_student->get_dropped_section();
								
				$date_time = $section_list[$i]->get_start_date();
				$start_date = $this->displayUtility->displayDateLong($date_time);		
				$date_time = $section_list[$i]->get_end_date();
				$end_date = $this->displayUtility->displayDateLong($date_time);
						
				$today = new DateTime("now");
				$end = new DateTime($end_date);
				$start = new DateTime($start_date);
				
				if((!$dropped_section) && ($start <= $today) && ($today <= $end)) 
				{
					$num_listed++;
					
					$link = "<a href='student-section-page.php?section_id=$section_id' 
								class='navigation'>Section 
								$section_id&nbsp:&nbsp$section_name
							</a>";
							
					echo "$link";
				}
			}
			
			if($num_listed == 0)
			{
				echo "<p class='navigation'>No current sections</p>";
			}
		}
		
		
		if($member_type == "professor")
		{
			for($i = 0; $i < $num_sections; $i++)
			{
				
				$section_id = $section_list[$i]->get_section_id();
				$section_name = $section_list[$i]->get_section_name();
				
				$date_time = $section_list[$i]->get_start_date();
				$start_date = $this->displayUtility->displayDateLong($date_time);		
				$date_time = $section_list[$i]->get_end_date();
				$end_date = $this->displayUtility->displayDateLong($date_time);
						
				$today = new DateTime("now");
				$end = new DateTime($end_date);
				$start = new DateTime($start_date);
				
				if(($start <= $today) && ($today <= $end))
				{
					$num_listed++;
					
					$link = "<a href='professor-section-page.php?section_id=$section_id' 
								class='navigation'>Section 
								$section_id&nbsp:&nbsp$section_name
							</a>";
						
					echo "$link";
				}
			}
		}
		
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
	
	
	public function displaySectionStudentList($section_id, $mdb_control)
	{
		echo "<table class='summary students'>
				<tr><th colspan='5'><h2>Section $section_id Student Members</h2></th></tr>";
		
		$student_list = array();
		$student_list = $this->getSectionStudentList($section_id, $mdb_control);
		$num_students = count($student_list);
		$header = "";
		$rows = array();
		
		if($num_students > 0)
		{				
			for($i = 0; $i < $num_students; $i++)
			{			
				$studentRow = array();
				
				$student_id = $student_list[$i]->get_student_id();
				$studentRow = $this->makeSectionStudentRow($student_list[$i]);
				
				if($i === 0) 
				{ 
					echo "<tr>" . $studentRow['header'] . "</tr>";
				}
				
				echo "<tr>" . $studentRow['data'] . "</tr>";
			}
		}
		else
		{
			echo "<tr><td colspan='5'>No students currently in this section.</td></tr>";
		}

		echo "</table>";
	}
	
	
	// Gets the list of all students in this section.
	public function getSectionStudentList($section_id, $mdb_control)
	{
		$student_list = array();
		$controller = $mdb_control->getController("section_students_view");
		$student_list = $controller->getByAttribute("section_id", $section_id);
		
		return $student_list;
	}
	
	
	public function makeSectionStudentRow($section_students_view)
	{
		$section_id = $section_students_view->get_section_id();
		$section_name = $section_students_view->get_section_name();
		$student_id = $section_students_view->get_student_id();
		$student_first_name = $section_students_view->get_student_first_name();
		$student_last_name = $section_students_view->get_student_last_name();
		$school_name = $section_students_view->get_school_name();
		$dropped_section = $section_students_view->get_dropped_section();
		$dropped = $dropped_section ? "Dropped" : "Enrolled";
		
		$row['header'] = "<th>Student ID</th><th>Student Name</th><th>School</th><th>Status</th>";
		$row['data'] = "<td>$student_id</td><td>$student_first_name&nbsp&nbsp$student_last_name
				</td><td>$school_name</td><td>$dropped</td>";

		return $row;
		
	}


	
}

 
?>