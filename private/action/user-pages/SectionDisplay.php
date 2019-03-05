<?php

class SectionDisplay
{
	private $displayUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
	}
	
	
	public function section_view_row($section_view)
	{
		$section_id = $section_view->get_section_id();
		$section_name = $section_view->get_section_name();
		$first_name = $section_view->get_professor_first_name();
		$last_name = $section_view->get_professor_last_name();
		$school_name = $section_view->get_school_name();
		
		$date_time = $section_view->get_start_date();
		$start_date = $this->displayUtility->displayDate($date_time);
		
		$date_time = $section_view->get_end_date();
		$end_date = $this->displayUtility->displayDate($date_time);
		
		$row = "<td><a href=''>Section $section_id&nbsp:&nbsp$section_name</a></td><td>" . 
				"$first_name&nbsp&nbsp$last_name</td><td>" . 
				$school_name . "</td><td>" . $start_date . "</td><td>" . 
				$end_date . "</td>";
		
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
			echo '<tr>';
			echo "<th>Section</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num_sections; $i++)
			{			
				$section_id = $section_list[$i]->get_section_id();
				$tableRow = $this->section_view_row($section_list[$i]);
				
				echo "<tr>$tableRow</tr>";
			}
		}
		
		echo "</table>";
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
	
	
	
	
	
	public function displaySectionStudentList($section_list, $mdb_control)
	{
		echo "<table class='section-student-list-table'>
				<tr><th colspan='5'>Section Memberships</th></tr>";
				
		$number_of_sections = count($section_list);
		
		if($number_of_sections <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any sections</td></tr>";
		}
		else
		{			
			for($i = 0; $i < $number_of_sections; $i++)
			{
				echo "<tr><th>Section</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th></tr>";
				
				$this->section_view_row($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$student_list = array();
				$student_list = $this->getSectionListOfStudents($section_id, $mdb_control);
				$number_of_students = count($student_list);
				
				if($number_of_students > 0)
				{				
					echo "<tr><th>Section</th><th>Student ID</th><th>Student Name</th><th>School</th><th>Start</th><th>End</th></tr>";
					for($j = 0; $j < $number_of_students; $j++)
					{					
						$this->displayUtility->displaySectionStudentRow($student_list[$j]);
					}
				}
				else
				{
					echo "<tr><td colspan='5'>No students currently in this section.</td></tr>";
				}
			}
			
		}
		
		echo "</table>";
	}
	
	
	public function displaySectionSummary_ByStudent($student_id, $section_list, $mdb_control)
	{
		$assignment_list = array();		
		$homework_list = array();
		$number_of_sections = count($section_list);
		
		if($number_of_sections > 0)
		{	
			echo "<table class='student_section_summary-table'>
					<tr><th colspan='5'>Section Details</th></tr>";

			for($i = 0; $i < $number_of_sections; $i++)
			{
				echo "<tr><th>Section</th><th>Professor</th><th>School</th>
						<th>Start</th><th>End</th></tr>";
			
				$this->section_view_row($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$assignment_list = array();
				$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
				
				$homework_list = array();
				$homework_list = $this->getSectionHomework_ByStudent($student_id, $section_id, $mdb_control);
				$number_of_homeworks = count($homework_list);
					
				for($j = 0; $j < $number_of_assignments; $j++)
				{					
					$this->displayUtility->displayAssignmentRow($assignment_list[$j]);
					$assignment_id = $assignment_list[$j]->get_assignment_id();
									
					for($k = 0; $k < $number_of_homeworks; $k++)
					{	
						$hmwk_assignment_id = $homework_list[$k]->get_assignment_id();
						
						if($hmwk_assignment_id == $assignment_id)
						{	$this->displayUtility->displayHomeworkRow($homework_list[$k]);
							break;
						}
					}					
				}// end assignment loop		
				
			} // end section loop
		}
		
		echo "</table>";
	}


	public function displaySectionSummary_ByProfessor($professor_id, $section_list, $mdb_control)
	{
		$assignment_list = array();		
		$homework_list = array();
		$number_of_sections = count($section_list);
		
		if($number_of_sections > 0)
		{	
			for($i = 0; $i < $number_of_sections; $i++)
			{
				echo "<table class='professor-section-summary-table'>
					<tr><th colspan='6'>Section Details</th></tr>";
					
				$this->section_view_row($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$assignment_list = array();
				$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
					
				for($j = 0; $j < $number_of_assignments; $j++)
				{					
					$this->displayUtility->displayAssignmentRow($assignment_list[$j]);
					$assignment_id = $assignment_list[$j]->get_assignment_id();
					
					$homework_list = array();
					$homework_list = $this->getSectionHomework_ByAssignment($assignment_id, $section_id, $mdb_control);
					$number_of_homeworks = count($homework_list);
									
					for($k = 0; $k < $number_of_homeworks; $k++)
					{	
						$this->displayUtility->displayHomeworkRow($homework_list[$k]);
					}					
				}// end assignment loop			
			} // end section loop
		}
		
		echo "</table>";
	}

	
		// Gets the list of all students in this section.
	public function getSectionListOfStudents($section_id, $mdb_control)
	{
		$student_list = array();
		$controller = $mdb_control->getController("section_students_view");
		$student_list = $controller->getByAttribute("section_id", $section_id);
		
		return $student_list;
	}


	
	
	public function displaySectionStudentRow($section_students_view)
	{
		$section_id = $section_students_view->get_section_id();
		$section_name = $section_students_view->get_section_name();
		$student_id = $section_students_view->get_student_id();
		$student_first_name = $section_students_view->get_student_first_name();
		$student_last_name = $section_students_view->get_student_last_name();
		$school_name = $section_students_view->get_school_name();
		$start_date = $section_students_view->get_start_date();
		$start_date = $this->displayDate($start_date);
		$end_date = $section_students_view->get_end_date();
		$end_date = $this->displayDate($end_date);
		
		echo "<tr><td>$section_id&nbsp:&nbsp$section_name</td><td>$student_id</td><td>$student_first_name&nbsp&nbsp$student_last_name</td><td>$school_name</td><td>$start_date</td><td>$end_date</td></tr>";
	}


	
	
}

 
?>