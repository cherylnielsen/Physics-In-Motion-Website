<?php

class AssignmentDisplay
{
	private $displayUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
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
				$student_list = $this->getAssignmentListOfStudents($assignment_id, $mdb_control);
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
				$assignment_list = $this->getAssignmentAssignments($assignment_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
				
				$homework_list = array();
				$homework_list = $this->getAssignmentHomework_ByStudent($student_id, $assignment_id, $mdb_control);
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
				$assignment_list = $this->getAssignmentAssignments($assignment_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
					
				for($j = 0; $j < $number_of_assignments; $j++)
				{					
					$this->displayUtility->displayAssignmentRow($assignment_list[$j]);
					$assignment_id = $assignment_list[$j]->get_assignment_id();
					
					$homework_list = array();
					$homework_list = $this->getAssignmentHomework_ByAssignment($assignment_id, $assignment_id, $mdb_control);
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

	
	// Gets all assignments from the database for this section.
	public function getSectionAssignments($section_id, $mdb_control)
	{
		$assignment_list = array();
		$controller = $mdb_control->getController("assignment_view");
		$assignment_list = $controller->getByAttribute("section_id", $section_id);
		
		return $assignment_list;
	}	
	
	
	// Gets all homeworks from the database for this assignment in this section for all students.
	public function getSectionHomework_ByAssignment($assignment_id, $section_id, $mdb_control)
	{
		$homework_list = array();
		$controller = $mdb_control->getController("homework");
		$homework_list = $controller->getByAttributes("assignment_id", $assignment_id, "section_id", $section_id);
		
		return $homework_list;
	}
	
	
	// Gets all homeworks from the database for this student in this section for all assignments.
	public function getSectionHomework_ByStudent($student_id, $section_id, $mdb_control)
	{
		$homework_list = array();
		$controller = $mdb_control->getController("homework");
		$homework_list = $controller->getByAttributes("student_id", $student_id, "section_id", $section_id);
		
		return $homework_list;
	}
	
	
	
	
	public function displayAssignmentRow($assignment_view)
	{
		$assignment_name = $assignment_view->get_assignment_name();
		$points_possible = $assignment_view->get_points_possible();
		$notes = $assignment_view->get_notes();
		
		$lab_id = $assignment_view->get_tutorial_lab_id();
		$lab_name = $assignment_view->get_tutorial_lab_name();
		$lab_introduction = $assignment_view->get_tutorial_lab_introduction();
		$lab_web_link = $assignment_view->get_tutorial_lab_web_link();
		
		$date_assigned = $assignment_view->get_date_assigned();
		$date_assigned = $this->displayDate($date_assigned);
		$date_due = $assignment_view->get_date_due();
		$date_due = $this->displayDate($date_due);
		
		echo "<tr><th>Assigned</th><th>Due</th>
				<th colspan='2'>Assignment</th>
				<th>Points Possible</th></tr>";
				
		echo "<tr><th>Tutorial Lab</th><th>Link</th>
				<th colspan='2'>Introduction</th>
				<th>Professor's Notes</th></tr>";
				
		echo "<tr><td>$date_assigned</td><td>Due $date_due</td>
				<td colspan='2'>$assignment_name</td>
				<td>$points_possible points</td></tr>";
				
		echo "<tr><td>$lab_id&nbsp:&nbsp$lab_name</td>
				<td>$lab_web_link</td>
				<td colspan='2'>$lab_introduction</td>
				<td>$notes</td></tr>";
	}
	
	
	public function displayHomeworkRow($homework)
	{
		$summary = $homework->get_lab_summary();		
		$data = $homework->get_lab_data();		
		$graphs = $homework->get_graphs();		
		$math = $homework->get_math();		
		$hints = $homework->get_hints();		
		$chat_session = $homework->get_chat_session();
		
		$date_submitted = $homework->get_date_submitted();
		$date_submitted = $this->displayDate($date_submitted);
		
		$points = $homework->get_points_earned();		
		$graded = $homework->get_was_graded();	
		$graded = $this->displayBoolean($graded);
		$hours = $homework->get_hours();
				
		echo "<tr><th>Date Submitted</th><th>Points Earned</th>
				<th>Graded ?</th><th>Hours</th><th>Summary</th></tr>";
		
		echo "<tr><td>$date_submitted</td><td>$points</td><td>$graded</td>
				<td>$hours hours</td><td>$summary</td></tr>";
				
		echo "<tr><th>Data</th><th>Graphs</th>
				<th>Math</th><th>Hints</th><th>Chat Session</th></tr>";
				
		echo "<tr><td>$data</td><td>$graphs</td>
				<td>$math</td><td>$hints</td><td>$chat_session</td></tr>";
	}
	
		
	
}

 
?>