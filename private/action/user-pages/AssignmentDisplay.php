<?php

class AssignmentDisplay
{
	private $displayUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
	}
	
	/***
	public function displayHomeworkSummary_ByStudent($student_id, $assignment_list, $mdb_control)
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
	**/

	public function displaySectionAssignments($section_id, $assignment_list, $mdb_control)
	{
		$num_assignments = count($assignment_list);
		
		if($num_assignments > 0)
		{	
			for($i = 0; $i < $num_assignments; $i++)
			{
				echo "<table class='summary'>
					<tr><th colspan='6'>Assignment Details</th></tr>";
					
				$this->displayAssignmentRow($assignment_list[$i]);
				$assignment_id = $assignment_list[$i]->get_assignment_id();
					
				// gets homeworks submitted from all students for this assignment
				$homework_list = array();
				$homework_list = $this->getHomeworkByAssignment($assignment_id, $section_id, $mdb_control);
				$number_of_homeworks = count($homework_list);
								
				echo "<tr><th colspan='6'>Homework Submitted</th></tr>";
								
				for($j = 0; $j < $number_of_homeworks; $j++)
				{	
					$date_submitted = $homework_list[$j]->get_date_submitted();
					$this->displayHomeworkRow($homework_list[$j]);
				}											
			} 
		}
		else
		{
			echo "<tr><td colspan='6'>No assignments for this section.</td></tr>";
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
	public function getHomeworkByAssignment($assignment_id, $section_id, $mdb_control)
	{
		$homework_list = array();
		$controller = $mdb_control->getController("homework_view");
		$homework_list = $controller->getByAttributes("assignment_id", $assignment_id, "section_id", $section_id);
		
		return $homework_list;
	}
	
	
	// Gets all homeworks from the database for this student in this section for all assignments.
	public function getHomeworkByStudent($student_id, $section_id, $mdb_control)
	{
		$homework_list = array();
		$controller = $mdb_control->getController("homework_view");
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
		$date_assigned = $this->displayUtility->displayDate($date_assigned);
		$date_due = $assignment_view->get_date_due();
		$date_due = $this->displayUtility->displayDate($date_due);
		
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
	
	
	public function displayHomeworkRow($homework_view)
	{		
		$date_submitted = $homework_view->get_date_submitted();
		
		if(isset($date_submitted))
		{
			$date_submitted = $this->displayUtility->displayDate($date_submitted);
			
			$summary = $homework_view->get_lab_summary();		
			$data = $homework_view->get_lab_data();		
			$graphs = $homework_view->get_graphs();		
			$math = $homework_view->get_math();		
			$hints = $homework_view->get_hints();		
			$chat_session = $homework_view->get_chat_session();
			$points = $homework_view->get_points_earned();		
			$graded = $homework_view->get_was_graded();	
			$was_graded = $graded ? "Yes" : "No";
			$hours = $homework_view->get_hours();
			
			echo "<tr><th>Date Submitted</th><th>Points Earned</th>
				<th>Graded ?</th><th>Hours</th><th>Summary</th></tr>";
		
			echo "<tr><td>$date_submitted</td><td>$points</td><td>$was_graded</td>
				<td>$hours hours</td><td>$summary</td></tr>";
				
			echo "<tr><th>Data</th><th>Graphs</th>
				<th>Math</th><th>Hints</th><th>Chat Session</th></tr>";
				
			echo "<tr><td>$data</td><td>$graphs</td>
				<td>$math</td><td>$hints</td><td>$chat_session</td></tr>";
		}
		else
		{
			echo "<tr><td colspan='6'>No homework submitted.</td></tr>";
		}		
	}
}

 
?>