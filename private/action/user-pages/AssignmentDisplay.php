<?php

class AssignmentDisplay
{
	private $displayUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
	}


	public function displaySectionAssignments($section_id, $mdb_control)
	{
		$assignment_list = array();
		$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
		$num_assignments = count($assignment_list);
		$row = array();
		
		echo "<table class='summary assignments'><tr><th colspan='8'>
				<a href=''>Assignments</a></th></tr>";
					
		if($num_assignments > 0)
		{						
			for($i = 0; $i < $num_assignments; $i++)
			{
				$row[$i] = $this->displayAssignmentRow($assignment_list[$i]);
			} 
			
			echo "<tr>" . $row[0]['header'] . "</tr>";
			
			for($i = 0; $i < $num_assignments; $i++)
			{
				echo "<tr>" . $row[$i]['data'] . "</tr>";
			} 
		}
		else
		{
			echo "<tr><td colspan='8'>No assignments for this section.</td></tr>";
		}
		
		echo "</table>";
	}
	
	
	public function displaySubmittedHomework($section_id, $mdb_control)
	{
		$assignment_list = array();
		$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
		$num_assignments = count($assignment_list);
		
		echo "<table class='summary homework'><tr><th colspan='8'>
				<a href=''>Homework Submitted</a></th></tr>";
				
		if($num_assignments === 0)
		{
			echo "<tr><td colspan='8'>No assignments for this section.</td></tr>";
		}
		
		for($i = 0; $i < $num_assignments; $i++)
		{
			$homework_list = array();
			$homework_list = $this->getHomeworkByAssignment($assignment_id, $section_id, $mdb_control);
			$num_homework = count($homework_list);
			
			for($j = 0; $j < $num_assignments; $j++)
			{
				
			}			
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
	
	
	public function displayPointsEarnedRow($homework_list)
	{		
		$num_assignments = count($homework_list);
		$headerRow;
		$gradeRow;
		$row = array();
			
		
		for($i = 0; $i < $num_assignments; $i++)
		{
			$assignment_id = $homework_list[$i]->get_assignment_id();	
			$graded = $homework_list[$i]->get_was_graded();	
			$was_graded = $graded ? "Yes" : "No";
			$points = $homework_list[$i]->get_points_earned();
			$points = $graded ? $points : "not graded";
			$date_submitted = $homework_list[$i]->get_date_submitted();
			
			if(isset($date_submitted))
			{
				$date_submitted = $this->displayUtility->displayDateShort($date_submitted);
			}
			else
			{
				$date_submitted = "not submitted";
			}
				
			$row[$i]['header'] = "<th>Assignment ID</th><th>Submitted</th><th>Points Earned</th>";
			$row[$i]['data'] = "<td>Assignment $assignment_id</td><td>$date_submitted</td><td>$points</td>";			
		}
		
		return $row;
	}
	
	
	public function displayAssignmentRow($assignment_view)
	{
		$assignment_id = $assignment_view->get_assignment_id();
		$assignment_name = $assignment_view->get_assignment_name();
		$points_possible = $assignment_view->get_points_possible();
		$notes = $assignment_view->get_notes();
		
		$lab_id = $assignment_view->get_tutorial_lab_id();
		$lab_name = $assignment_view->get_tutorial_lab_name();
		$lab_introduction = $assignment_view->get_tutorial_lab_introduction();
		$lab_web_link = $assignment_view->get_tutorial_lab_web_link();
		
		$date_assigned = $assignment_view->get_date_assigned();
		$date_assigned = $this->displayUtility->displayDateShort($date_assigned);
		$date_due = $assignment_view->get_date_due();
		$date_due = $this->displayUtility->displayDateShort($date_due);
		
		$row = array();
		$row['header'] =  "<th colspan='2'>Assignment</th><th>Date Assigned</th><th>Date Due</th>
				<th>Tutorial Lab</th><th>Points Possible</th><th>Professor's Notes</th>";
				
		$row['data'] =  "<td>$assignment_id</td><td>$assignment_name</td>
				<td>$date_assigned</td><td>$date_due</td>
				<td>$lab_id&nbsp:&nbsp$lab_name</td>
				<td>$points_possible Points</td><td><a href=''>$notes</a></td>";
				
		return $row;
	}
	
	
	public function displayHomeworkRow($homework_view)
	{		
		$date_submitted = $homework_view->get_date_submitted();
		
		if(isset($date_submitted))
		{
			$date_submitted = $this->displayUtility->displayDateShort($date_submitted);
			
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
			
			$student_id = $homework_view->get_student_id();
			$student_first_name = $homework_view->get_student_first_name();
			$student_last_name = $homework_view->get_student_last_name();
			$assignment_id = $homework_view->get_assignment_id();
			
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