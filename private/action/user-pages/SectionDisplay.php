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
	
	
	public function sectionViewInteractiveRow($section_view)
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
		
		$link = "<a href='professor-section-page.php?section_id=$section_id'>";
		$row = "<td>$link" . "Section $section_id&nbsp:&nbsp$section_name</a></td>		
				<td>$first_name&nbsp&nbsp$last_name</td> 
				<td>$school_name</td><td>$start_date</td><td>$end_date</td>";
		
		return $row;
	}
	
	
	public function displaySectionMembershipTable($section_list, $mdb_control)
	{
		echo "<table class='summary'>
				<tr><th colspan='5'>Section Memberships</th></tr>";
				
		$num_sections = count($section_list);
		
		if($num_sections <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num_sections; $i++)
			{			
				$section_id = $section_list[$i]->get_section_id();
				$tableRow = $this->sectionViewInteractiveRow($section_list[$i]);
				
				echo "<tr>$tableRow</tr>";
			}
		}
		
		echo "</table>";
	}
	
	
	public function displaySectionShortList($section_list, $mdb_control)
	{
		echo "<tr><th>Section Memberships</th></tr>";
				
		$num_sections = count($section_list);
		
		if($num_sections <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any sections</td></tr>";
		}
		else
		{
			for($i = 0; $i < $num_sections; $i++)
			{			
				$section_id = $section_list[$i]->get_section_id();
				$section_name = $section_list[$i]->get_section_name();
				$link = "<a href='professor-section-page.php?section_id=$section_id' class='member-link'>";
				$tableRow = "<td>$link" . "Section $section_id&nbsp:&nbsp$section_name</a></td>";
				echo "<tr>$tableRow</tr>";
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
				<tr><th colspan='5'>Section $section_id Student Members</th></tr>";
		
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