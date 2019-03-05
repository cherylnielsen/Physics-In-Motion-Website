<?php

class AssignmentDisplay
{
	private $displayUtility;
	private $dataUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
		$this->dataUtility = new DataUtility();
	}
	
	
	public function displayAssignmentTable($assignment_list, $mdb_control)
	{
		echo "<table class='assignment-membership-table'>
				<tr><th colspan='5'>Assignment Memberships</th></tr>";
				
		$num = count($assignment_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any assignments</td></tr>";
		}
		else
		{
			echo "<tr><th>Assignment</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$this->displayUtility->displayAssignmentRow($assignment_list[$i]);
			}
		}
		
		echo "</table>";
	}
	
	
	public function displayAssignmentStudentList($assignment_list, $mdb_control)
	{
		echo "<table class='assignment-student-list-table'>
				<tr><th colspan='5'>Assignment Memberships</th></tr>";
				
		$number_of_assignments = count($assignment_list);
		
		if($number_of_assignments <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any assignments</td></tr>";
		}
		else
		{			
			for($i = 0; $i < $number_of_assignments; $i++)
			{
				echo "<tr><th>Assignment</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th></tr>";
				
				$this->displayUtility->displayAssignmentRow($assignment_list[$i]);
				$assignment_id = $assignment_list[$i]->get_assignment_id();
				
				$student_list = array();
				$student_list = $this->dataUtility->getAssignmentListOfStudents($assignment_id, $mdb_control);
				$number_of_students = count($student_list);
				
				if($number_of_students > 0)
				{				
					echo "<tr><th>Assignment</th><th>Student ID</th><th>Student Name</th><th>School</th><th>Start</th><th>End</th></tr>";
					for($j = 0; $j < $number_of_students; $j++)
					{					
						$this->displayUtility->displayAssignmentStudentRow($student_list[$j]);
					}
				}
				else
				{
					echo "<tr><td colspan='5'>No students currently in this assignment.</td></tr>";
				}
			}
			
		}
		
		echo "</table>";
	}
	
	
	public function displayAssignmentSummary_ByStudent($student_id, $assignment_list, $mdb_control)
	{
		$assignment_list = array();		
		$homework_list = array();
		$number_of_assignments = count($assignment_list);
		
		if($number_of_assignments > 0)
		{	
			echo "<table class='student_assignment_summary-table'>
					<tr><th colspan='5'>Assignment Details</th></tr>";

			for($i = 0; $i < $number_of_assignments; $i++)
			{
				echo "<tr><th>Assignment</th><th>Professor</th><th>School</th>
						<th>Start</th><th>End</th></tr>";
			
				$this->displayUtility->displayAssignmentRow($assignment_list[$i]);
				$assignment_id = $assignment_list[$i]->get_assignment_id();
				
				$assignment_list = array();
				$assignment_list = $this->dataUtility->getAssignmentAssignments($assignment_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
				
				$homework_list = array();
				$homework_list = $this->dataUtility->getAssignmentHomework_ByStudent($student_id, $assignment_id, $mdb_control);
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
				
			} // end assignment loop
		}
		
		echo "</table>";
	}


	public function displayAssignmentSummary_ByProfessor($professor_id, $assignment_list, $mdb_control)
	{
		$assignment_list = array();		
		$homework_list = array();
		$number_of_assignments = count($assignment_list);
		
		if($number_of_assignments > 0)
		{	
			for($i = 0; $i < $number_of_assignments; $i++)
			{
				echo "<table class='professor-assignment-summary-table'>
					<tr><th colspan='6'>Assignment Details</th></tr>";
					
				$this->displayUtility->displayAssignmentRow($assignment_list[$i]);
				$assignment_id = $assignment_list[$i]->get_assignment_id();
				
				$assignment_list = array();
				$assignment_list = $this->dataUtility->getAssignmentAssignments($assignment_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
					
				for($j = 0; $j < $number_of_assignments; $j++)
				{					
					$this->displayUtility->displayAssignmentRow($assignment_list[$j]);
					$assignment_id = $assignment_list[$j]->get_assignment_id();
					
					$homework_list = array();
					$homework_list = $this->dataUtility->getAssignmentHomework_ByAssignment($assignment_id, $assignment_id, $mdb_control);
					$number_of_homeworks = count($homework_list);
									
					for($k = 0; $k < $number_of_homeworks; $k++)
					{	
						$this->displayUtility->displayHomeworkRow($homework_list[$k]);
					}					
				}// end assignment loop			
			} // end assignment loop
		}
		
		echo "</table>";
	}

	
	
	
}

 
?>