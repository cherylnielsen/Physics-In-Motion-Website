<?php

class AssignmentDisplay
{
	private $displayUtility;
	private $sectionDisplay;
	private $base_path = "attachments";
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
		$this->sectionDisplay = new SectionDisplay();
	}


	public function displaySectionAssignments($section_id, $mdb_control, $for_profesor)
	{
		$assignment_list = array();
		$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
		$num_assignments = count($assignment_list);
		$row = array();
		
		echo "<table class='summary assignments'><tr>
				<th colspan='15'><h2>Assignments</h2></th></tr>";
					
		if($num_assignments > 0)
		{						
			for($i = 0; $i < $num_assignments; $i++)
			{
				$row[$i] = $this->displayAssignmentRow($assignment_list[$i], $for_profesor, $mdb_control);
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
		$row = array();
		$header = "";
		
		echo "<table class='summary homework'><tr>
				<th colspan='18'><h2>Homework Submitted</h2></th></tr>";
				
		if($num_assignments === 0)
		{
			echo "<tr><td colspan='18'>No assignments for this section.</td></tr>";
		}
		
		for($i = 0; $i < $num_assignments; $i++)
		{
			$assignment_id = $assignment_list[$i]->get_assignment_id();
			$homework_list = array();
			$homework_list = $this->getHomeworkByAssignment($assignment_id, $section_id, $mdb_control);
			$num_homework = count($homework_list);
			
			if($num_homework === 0)
			{
				$assignment_name = $assignment_list[$i]->get_assignment_name();
				if(isset($header)) { echo "<tr> $header </tr>"; }
				
				echo "<tr>
					<td>$section_id</td><td>$assignment_id</td><td>$assignment_name</td>
					<td colspan='15'>No homework for this assignment.</td></tr>";
			}
			else
			{						
				for($j = 0; $j < $num_homework; $j++)
				{
					$row[$j] = $this->displayProfessorHomeworkRow($homework_list[$j]);
				} 
				
				echo "<tr>" . $row[0]['header'] . "</tr>";
				$header = $row[0]['header'];
				
				for($k = 0; $k < $num_homework; $k++)
				{
					echo "<tr>" . $row[$k]['data'] . "</tr>";
				} 
			}
		} 
		
		echo "</table>";
	}


	public function displayStudentHomework($section_id, $student_id, $mdb_control)
	{
		$assignment_list = array();
		$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
		$num_assignments = count($assignment_list);
		$row = array();
		
		echo "<form id='studentHmwkTableForm' method='POST'>
				<table class='summary homework'><tr>
					<th colspan='18'><h2>Homework</h2></th></tr>";
				
		if($num_assignments === 0)
		{
			echo "<tr><td colspan='18'>No assignments for this section.</td></tr>";
		}
		
		for($i = 0; $i < $num_assignments; $i++)
		{
			$assignment_id = $assignment_list[$i]->get_assignment_id();
			$homework = $this->getOneHomework($section_id, $assignment_id, $student_id, $mdb_control);
			
			if(!isset($homework))
			{
				echo "<tr><td colspan='18'>No homework for this assignment.</td></tr>";
			}
			else
			{						
				$row = $this->displayStudentHomeworkRow($homework);	
				
				if($i === 0)
				{
					echo "<tr>" . $row['header'] . "</tr>";
				}
				
				echo "<tr>" . $row['data'] . "</tr>"; 
			}
		} 
		
		echo "</table></form>";
	}
	

	// Gets all assignments from the database for this section.
	public function getSectionAssignments($section_id, $mdb_control)
	{
		$assignment_list = array();
		$controller = $mdb_control->getController("assignment_view");
		$assignment_list = $controller->getByAttribute("section_id", $section_id);
		
		return $assignment_list;
	}	
	
	
	// Gets set of homeworks from the database for this assignment in this section for all students.
	public function getHomeworkByAssignment($assignment_id, $section_id, $mdb_control)
	{
		$homework_list = array();
		$controller = $mdb_control->getController("homework_view");
		$homework_list = $controller->getByAttributes("assignment_id", $assignment_id, "section_id", $section_id);
		
		return $homework_list;
	}
	
	
	// Gets set of homeworks from the database for this student in this section for all assignments.
	public function getHomeworkByStudent($student_id, $section_id, $mdb_control)
	{
		$homework_list = array();
		$controller = $mdb_control->getController("homework_view");
		$homework_list = $controller->getByAttributes("student_id", $student_id, "section_id", $section_id);
		
		return $homework_list;
	}
	
	
	// Gets one homework from the database.
	public function getOneHomework($section_id, $assignment_id, $student_id, $mdb_control)
	{
		$homework = null;
		$controller = $mdb_control->getController("homework_view");
		$homework = $controller->getOneHomeworkView($section_id, $assignment_id, $student_id);
		
		return $homework;
	}
	
	
	public function displayAssignmentRow($assignment_view, $for_profesor, $mdb_control)
	{
		$assignment_id = $assignment_view->get_assignment_id();
		$assignment_name = $assignment_view->get_assignment_name();
		$section_id = $assignment_view->get_section_id();
		$section_name = $assignment_view->get_section_name();
		$points_possible = $assignment_view->get_points_possible();
		//$notes = $assignment_view->get_notes();
		
		$lab_id = $assignment_view->get_tutorial_lab_id();
		$lab_name = $assignment_view->get_tutorial_lab_name();
		$lab_introduction = $assignment_view->get_tutorial_lab_introduction();
		$lab_web_link = $assignment_view->get_tutorial_lab_web_link();
		
		$date_assigned = $assignment_view->get_date_assigned();
		$date_assigned = $this->displayUtility->displayDateShort($date_assigned);
		$date_due = $assignment_view->get_date_due();
		$date_due = $this->displayUtility->displayDateShort($date_due);
		
		$row = array();
		
		$header = "<th colspan='2'>Section</th>
					<th colspan='2'>Assignment</th>
					<th>Date Assigned</th><th>Date Due</th>
					<th>Tutorial Lab</th><th>Points Possible</th>
					<th>Attachments</th>";
		
		$data =  "<td>$section_id</td><td>$section_name</td>
					<td>$assignment_id</td><td>$assignment_name</td>
					<td>$date_assigned</td><td>$date_due</td>
					<td>$lab_id&nbsp:&nbsp$lab_name <br>
					<a href='templink.php' class='assignment_link'> Start Now </a></td>
					<td>$points_possible Points</td>";
					
		$attachments = array(); 
		$controller = $mdb_control->getController("assignment_attachment");
		$attachments = $controller->getByAttribute("assignment_id", $assignment_id);
		$attachment_list = " ";
		
		for($i = 0; $i < count($attachments); $i++)
		{
			$attachment_id = $attachments[$i]->get_assignment_attachment_id();
			$filepath = $attachments[$i]->get_filepath();
			$filename = $attachments[$i]->get_filename();
			$attachment_link = $this->base_path . "/$filepath/$filename";
			$attachment_list .= "<a href='$attachment_link' download
									class='assignment_link'>$filename</a>";
		}
					
		$data .=  "<td>$attachment_list</td>";		
				
		if($for_profesor)
		{					
			$url = "professor-form-page.php?form_type=edit_assignment";
			$url .= "&assignment_id=$assignment_id&section_id=$section_id";
			
			$header = "<th>Edit Assignment</th>" . $header; 	
			$dataEdit = "<td><a href='$url' class='assignment_button' >Edit</a></td>"; 					
			$data = $dataEdit . $data;	
		}
				
		$row['header'] =  $header;
		$row['data'] =  $data;
				
		return $row;
	}
	
	
	public function displayProfessorHomeworkRow($homework_view)
	{		
		$date_submitted = $homework_view->get_date_submitted();
		$date_submitted = $this->displayUtility->displayDateShort($date_submitted);
		$row = array();
		$row['data'] = "";
		
		$row['header'] = "<th>Section ID</th><th colspan='2'>Assignment</th>
				<th>Tutorial Lab ID</th><th colspan='2'>Student</th>
				<th>Date Submitted</th><th>Points Possible</th><th>Points Earned</th>
				<th>Hours</th><th>Summary</th><th>Homework Set</th>";
		
		$homework_id = $homework_view->get_homework_id();
		
		$student_id = $homework_view->get_student_id();
		$student_first_name = $homework_view->get_student_first_name();
		$student_last_name = $homework_view->get_student_last_name();
		$assignment_id = $homework_view->get_assignment_id();
		$assignment_name = $homework_view->get_assignment_name();
		$section_id = $homework_view->get_section_id();
		$tutorial_lab_id = $homework_view->get_tutorial_lab_id();
			
		if(isset($date_submitted))
		{
			$summary = $homework_view->get_lab_summary();		
			$points_earned = $homework_view->get_points_earned();		
			$graded = $homework_view->get_was_graded();	
			$hours = $homework_view->get_hours();
			$points_possible = $homework_view->get_points_possible();
			
			
			if(!$graded)
			{
				$points_earned = "<button class='table-button' name='grade_homework'
									value='$homework_id'>Grade Homework</button>";
			}			
			
			$row['data'] = "<td>$section_id</td><td>$assignment_id</td><td>$assignment_name</td>
				<td>$tutorial_lab_id</td><td>$student_id</td>
				<td>$student_first_name&nbsp&nbsp$student_last_name</td>
				<td>$date_submitted</td><td class='center'>$points_possible</td>
				<td class='center'>$points_earned</td>
				<td>$hours hours</td><td><a href=''>$summary</a></td>
				<td><a href=''>Homework Set</a></td>";
		}
		else
		{			
			$row['data'] = "<td>$section_id</td><td>$assignment_id</td>
				<td>$assignment_name</td>
				<td>$tutorial_lab_id</td><td>$student_id</td>
				<td>$student_first_name&nbsp&nbsp$student_last_name</td>
				<td colspan='12'>Not Submitted</td>";
		}	

		return $row;
		
	}


	public function displayStudentHomeworkRow($homework_view)
	{		
		$row = array();
		$row['data'] = "";
		
		$row['header'] = "<th>Section ID</th><th colspan='2'>Assignment</th>
				<th>Tutorial Lab ID</th>
				<th>Date Submitted</th><th>Points Possible</th><th>Points Earned</th>
				<th>Hours</th><th>Summary</th><th>Homework Set</th>";
				
		$homework_id = $homework_view->get_homework_id();		
		$student_id = $homework_view->get_student_id();
		
		$assignment_id = $homework_view->get_assignment_id();
		$assignment_name = $homework_view->get_assignment_name();
		
		$section_id = $homework_view->get_section_id();
		$tutorial_lab_id = $homework_view->get_tutorial_lab_id();
		$summary = $homework_view->get_lab_summary();
		
		$points_earned = $homework_view->get_points_earned();		
		$graded = $homework_view->get_was_graded();	
		$points_earned = $graded ? $points_earned : "Not Graded";
		
		$hours = $homework_view->get_hours();
		$points_possible = $homework_view->get_points_possible();			
		$date_submitted = $homework_view->get_date_submitted();		
		
		if(!isset($date_submitted))
		{
			$date_submitted = "<button class='table-button' name='submit_homework'
								value='$homework_id'>Submit Homework</button>";
		}
		else
		{
			$date_submitted = $this->displayUtility->displayDateShort($date_submitted);
		}
			
		$row['data'] = "<td>$section_id</td><td>$assignment_id</td><td>$assignment_name</td>
			<td>$tutorial_lab_id</td>
			<td>$date_submitted</td><td class='center'>$points_possible</td>
			<td class='center'>$points_earned</td>
			<td>$hours hours</td><td><a href=''>$summary</a></td>
			<td><a href=''>Homework Set</a></td>";

		return $row;
		
	}
	

	
}
 
 
?>