<?php

class HomeworkDisplay
{
	private $displayUtility;
	private $dataUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
		$this->dataUtility = new DataUtility();
	}
	
	
	public function displayHomeworkTable($homework_list, $mdb_control)
	{
		echo "<table class='homework-membership-table'>
				<tr><th colspan='5'>Homework Memberships</th></tr>";
				
		$num = count($homework_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any homeworks</td></tr>";
		}
		else
		{
			echo "<tr><th>Homework</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$this->displayUtility->displayHomeworkRow($homework_list[$i]);
			}
		}
		
		echo "</table>";
	}
	
	
	public function displayHomeworkStudentList($homework_list, $mdb_control)
	{
		echo "<table class='homework-student-list-table'>
				<tr><th colspan='5'>Homework Memberships</th></tr>";
				
		$number_of_homeworks = count($homework_list);
		
		if($number_of_homeworks <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any homeworks</td></tr>";
		}
		else
		{			
			for($i = 0; $i < $number_of_homeworks; $i++)
			{
				echo "<tr><th>Homework</th><th>Professor</th><th>School</th>
					<th>Start Date</th><th>End Date</th></tr>";
				
				$this->displayUtility->displayHomeworkRow($homework_list[$i]);
				$homework_id = $homework_list[$i]->get_homework_id();
				
				$student_list = array();
				$student_list = $this->dataUtility->getHomeworkListOfStudents($homework_id, $mdb_control);
				$number_of_students = count($student_list);
				
				if($number_of_students > 0)
				{				
					echo "<tr><th>Homework</th><th>Student ID</th><th>Student Name</th><th>School</th><th>Start</th><th>End</th></tr>";
					for($j = 0; $j < $number_of_students; $j++)
					{					
						$this->displayUtility->displayHomeworkStudentRow($student_list[$j]);
					}
				}
				else
				{
					echo "<tr><td colspan='5'>No students currently in this homework.</td></tr>";
				}
			}
			
		}
		
		echo "</table>";
	}
	
	
	public function displayHomeworkSummary_ByStudent($student_id, $homework_list, $mdb_control)
	{
		$assignment_list = array();		
		$homework_list = array();
		$number_of_homeworks = count($homework_list);
		
		if($number_of_homeworks > 0)
		{	
			echo "<table class='student_homework_summary-table'>
					<tr><th colspan='5'>Homework Details</th></tr>";

			for($i = 0; $i < $number_of_homeworks; $i++)
			{
				echo "<tr><th>Homework</th><th>Professor</th><th>School</th>
						<th>Start</th><th>End</th></tr>";
			
				$this->displayUtility->displayHomeworkRow($homework_list[$i]);
				$homework_id = $homework_list[$i]->get_homework_id();
				
				$assignment_list = array();
				$assignment_list = $this->dataUtility->getHomeworkAssignments($homework_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
				
				$homework_list = array();
				$homework_list = $this->dataUtility->getHomeworkHomework_ByStudent($student_id, $homework_id, $mdb_control);
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
				
			} // end homework loop
		}
		
		echo "</table>";
	}


	public function displayHomeworkSummary_ByProfessor($professor_id, $homework_list, $mdb_control)
	{
		$assignment_list = array();		
		$homework_list = array();
		$number_of_homeworks = count($homework_list);
		
		if($number_of_homeworks > 0)
		{	
			for($i = 0; $i < $number_of_homeworks; $i++)
			{
				echo "<table class='professor-homework-summary-table'>
					<tr><th colspan='6'>Homework Details</th></tr>";
					
				$this->displayUtility->displayHomeworkRow($homework_list[$i]);
				$homework_id = $homework_list[$i]->get_homework_id();
				
				$assignment_list = array();
				$assignment_list = $this->dataUtility->getHomeworkAssignments($homework_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
					
				for($j = 0; $j < $number_of_assignments; $j++)
				{					
					$this->displayUtility->displayAssignmentRow($assignment_list[$j]);
					$assignment_id = $assignment_list[$j]->get_assignment_id();
					
					$homework_list = array();
					$homework_list = $this->dataUtility->getHomeworkHomework_ByAssignment($assignment_id, $homework_id, $mdb_control);
					$number_of_homeworks = count($homework_list);
									
					for($k = 0; $k < $number_of_homeworks; $k++)
					{	
						$this->displayUtility->displayHomeworkRow($homework_list[$k]);
					}					
				}// end assignment loop			
			} // end homework loop
		}
		
		echo "</table>";
	}

	
	
	
}

 
?>