<?php

class DisplaySections
{
	private $displayUtility;
	private $dataUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new MemberDisplayUtilities();
		$this->dataUtility = new MemberDataUtilities();
	}
	
	
	public function displaySectionTable($section_list, $mdb_control)
	{
		echo "<table class='section-membership-table'>
				<tr><th colspan='5'>Section Memberships</th></tr>";
				
		$num = count($section_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$this->displayUtility->displaySectionRow($section_list[$i]);
			}
		}
		
		echo "</table>";
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
				
				$this->displayUtility->displaySectionRow($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$student_list = array();
				$student_list = $this->dataUtility->getSectionListOfStudents($section_id, $mdb_control);
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
			
				$this->displayUtility->displaySectionRow($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$assignment_list = array();
				$assignment_list = $this->dataUtility->getSectionAssignments($section_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
				
				$homework_list = array();
				$homework_list = $this->dataUtility->getSectionHomework_ByStudent($student_id, $section_id, $mdb_control);
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
					
				$this->displayUtility->displaySectionRow($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$assignment_list = array();
				$assignment_list = $this->dataUtility->getSectionAssignments($section_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
					
				for($j = 0; $j < $number_of_assignments; $j++)
				{					
					$this->displayUtility->displayAssignmentRow($assignment_list[$j]);
					$assignment_id = $assignment_list[$j]->get_assignment_id();
					
					$homework_list = array();
					$homework_list = $this->dataUtility->getSectionHomework_ByAssignment($assignment_id, $section_id, $mdb_control);
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

	
	
	
}

 
?>