<?php

class AssignmentTables
{
	private $sectionTables;
	private $submitHomework = 1;
	private $gradeHomework = 2;
	private $changeGrade = 3;
	private $deleteAssignment = 4;
	
	
	public function __construct() 
	{
		$this->sectionTables = new SectionTables();
	}


	public function displaySectionAssignments($section_id, $mdb_control, $member_type)
	{
		$assignment_list = array();
		$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
		$num_assignments = count($assignment_list);
		$row = array();
		
		echo "<form id='assignmentTableForm' method='POST'>
				<table class='summary assignments'>
					<tr><th colspan='15'><h2>Section $section_id Assignments</h2></th></tr>";
					
		if($num_assignments > 0)
		{						
			for($i = 0; $i < $num_assignments; $i++)
			{
				$date_assigned = $assignment_list[$i]->get_date_assigned();
				$assigned = new DateTime($date_assigned);
				$date_assigned = date("D, m/d/y", strtotime($date_assigned));
				$today = new DateTime("today");
				
				if($member_type === "professor")
				{
					$assignment_id = $assignment_list[$i]->get_assignment_id();
					$row_id = "assignment_" . $assignment_id;
					$row[$i] = $this->displayAssignmentRow($assignment_list[$i], 
										$member_type, $mdb_control);
					if($i == 0) 
					{ 
						echo "<tr>" . $row[0]['header'] . "</tr>"; 
					}
					
					echo "<tr id='$row_id'>" . $row[$i]['data'] . "</tr>";
					
				}
				else if(($member_type === "student") && (($today >= $assigned)))
				{
					$row[$i] = $this->displayAssignmentRow($assignment_list[$i], 
										$member_type, $mdb_control);
										
					if(($i == 0) && !empty($row))
					{ 
						echo "<tr>" . $row[0]['header'] . "</tr>"; 
					}
					
					echo "<tr>" . $row[$i]['data'] . "</tr>";
				}
			} 
		}
		
		if(($num_assignments == 0) || (empty($row))) 
		{
			echo "<tr><td colspan='8'>No assignments for this section.</td></tr>";
		}
		
		echo "</table></form>";
		
	}
	
	
	public function displaySubmittedHomework($section_id, $mdb_control)
	{
		$assignment_list = array();
		$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
		$num_assignments = count($assignment_list);
		$row = array();
		$header = "";
		
		echo "<form id='professorHmwkTableForm' method='POST'>
				<table class='summary'>
					<tr><th colspan='18'><h2>Section $section_id Homework Submitted</h2></th></tr>";
				
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
			
			if($num_homework == 0)
			{
				$assignment_name = $assignment_list[$i]->get_assignment_name();
				
				echo "<tr><th>Section ID</th><th colspan='2'>Assignment</th>
					<th colspan='10'> </th></tr>";
				
				echo "<tr><td>$section_id</td><td>$assignment_id</td><td>$assignment_name</td>
					<td colspan='10'>No homework for this assignment yet.</td></tr>";
			}
			else
			{		
				for($j = 0; $j < $num_homework; $j++)
				{
					$row[$j] = $this->displayProfessorHomeworkRow($homework_list[$j]);	
					
					if($j == 0) 
					{ 
						$header =  "<tr>" . $row[0]['header'] . "</tr>"; 
						echo "$header"; 
					}	
				
					echo "<tr>" . $row[$j]['data'] . "</tr>";
				} 
			}
		} 
		
		echo "</table></form>";
	}


	public function displayStudentHomework($section_id, $student_id, $mdb_control)
	{
		$assignment_list = array();
		$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
		$num_assignments = count($assignment_list);
		$homework_list = array();
		$homework_list = $this->getHomeworkByStudent($student_id, $section_id, $mdb_control);
		$num_homework = count($homework_list);
		$row = array();
		
		echo "<form id='studentHmwkTableForm' method='POST'>
				<table class='summary'>
					<tr><th colspan='18'><h2>Section $section_id Homework</h2></th></tr>";
				
		if($num_assignments == 0  || $num_homework == 0)
		{
			echo "<tr><td colspan='18'>No assignments for this section.</td></tr>";
		}
		
		for($i = 0; $i < $num_assignments; $i++)
		{
			$assignment_id = $assignment_list[$i]->get_assignment_id();
			$homework = $this->getOneHomework($section_id, $assignment_id, $student_id, $mdb_control);
			
			if(!empty($homework))
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
	
	
	public function displayNumAssignmentsDueSoon($section_list, $mdb_control)
	{
		$numSections = count($section_list);
		$numDueSoon = array();
		
		//$number['dueNow'] = $numDueNow;
		//$number['nextWeek'] = $numNextWeek;
		
		for($i = 0; $i < $numSections; $i++)
		{
			$section_id = $section_list[$i]->get_section_id();
			$assignment_list = array();
			$assignment_list = $this->getSectionAssignments($section_id, $mdb_control);
			$numDueSoon[$section_id] = $this->getAssignmentsDueSoon($assignment_list);
		}
		
		$table_heading = "<table class='summary assignment-summary'>
				<tr><th colspan='10'><h2>Assignment Summary</h2></th></tr>"; 	
							
		echo "$table_heading";		
		
		$table_heading = "<tr><th> </th>";
		$row_24hr = "<tr><th>Due in 24-48 Hours</th>";
		$row_7day = "<tr><th>Due in Next 7 Days</th>";
		
		for($i = 0; $i < $numSections; $i++)
		{
			$section_id = $section_list[$i]->get_section_id();			
			$day = $numDueSoon[$section_id]['dueNow'];
			$week = $numDueSoon[$section_id]['nextWeek'];
			
			$table_heading .= "<th>Section $section_id</th>";
			$row_24hr .= "<td>$day</td>";
			$row_7day .= "<td>$week</td>";			
		}
		
		$table_heading .= "</tr>";	
		$row_24hr .= "</tr>";
		$row_7day .= "</tr>";		
		
		echo "$table_heading";
		echo "$row_24hr";
		echo "$row_7day";		
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
	
	
	public function getAssignmentsDueSoon($assignment_list)
	{
		$number = array();
		$numAssignments = count($assignment_list);
		$numNextWeek = 0;	
		$numDueNow = 0;		
		$nextWeek = new DateTime("+1 week");
		$dayOr2 = new DateTime("+2 day");
		$yesterday = new DateTime("-1 day");
		
		for($i = 0; $i < $numAssignments; $i++)
		{
			$due = $assignment_list[$i]->get_date_due();		
			$dateDue = new DateTime($due);
			
			if(($yesterday <= $dateDue) && ($dateDue <= $dayOr2)) { $numDueNow++; }
			if(($yesterday <= $dateDue) && ($dateDue <= $nextWeek)) { $numNextWeek++; }
		}
		
		$number['dueNow'] = $numDueNow;
		$number['nextWeek'] = $numNextWeek;
	
		return $number;
	}
	
	
	public function displayAssignmentRow($assignment_view, $member_type, $mdb_control)
	{
		$date_assigned = $assignment_view->get_date_assigned();
		$assigned = new DateTime($date_assigned);
		$date_assigned = date("D, m/d/y", strtotime($date_assigned));
		$today = new DateTime("today");
		$date_due = $assignment_view->get_date_due();
		$date_due = date("D, m/d/y", strtotime($date_due));
		
		$assignment_id = $assignment_view->get_assignment_id();
		$assignment_name = $assignment_view->get_assignment_name();
		$section_id = $assignment_view->get_section_id();
		$section_name = $assignment_view->get_section_name();
		$points_possible = $assignment_view->get_points_possible();
		
		$lab_id = $assignment_view->get_tutorial_lab_id();
		$lab_name = $assignment_view->get_tutorial_lab_name();
		$lab_introduction = $assignment_view->get_tutorial_lab_introduction();
		$lab_web_link = $assignment_view->get_tutorial_lab_web_link();
		
		$row = array();
		
		$header = "<th>Assignment</th>
					<th>Date Assigned</th><th>Date Due</th>
					<th>Tutorial Lab</th><th>Points Possible</th>
					<th>Attachments</th>";
		
		$data =  "<td>$assignment_name</td>
					<td>$date_assigned</td>
					<td>$date_due</td>
					<td>$lab_id&nbsp;:&nbsp;$lab_name <br>
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
			$attachment_link = "$filepath/$filename";

			$attachment_list .= "<a href='$attachment_link' download 
								class='assignment_link'>$filename</a>";
		}
					
		$data .=  "<td>$attachment_list</td>";		
				
		if($member_type == "professor")
		{					
			$url = "professor-form-page.php?form_type=edit_assignment
					&assignment_id=$assignment_id&section_id=$section_id";
			
			$header = "<th> </th>" . $header; 	
			
			// If the date assigned is already today or before then 
			// only make edit available.  
			// We do not want to delete assignments that may 
			// already be started by students.
			if($today >= $assigned)
			{
				$dataEdit = "<td>
						<a href='$url' class='table-button' >
						<span class='fa fa-pencil'>&nbsp; Edit</span></a>
					</td>"; 
			}
			else
			{
				$actionID = $this->deleteAssignment;
				
				$dataEdit = "<td>
						<a href='$url' class='table-button' >
						<span class='fa fa-pencil'>&nbsp; Edit</span></a>
						
						<button type='button' class='table-button' 
							name='delete_assignment' value='$assignment_id' 
							onclick='homeworkActions($assignment_id, $actionID);' >
							<span class='fa fa-remove red'>&nbsp; Delete</span>
						</button>
					</td>"; 		
			}		
										
			$data = $dataEdit . $data;	
		}
				
		$row['header'] =  $header;
		$row['data'] =  $data;
				
		return $row;
	}
	
	
	public function displayProfessorHomeworkRow($homework_view)
	{		
		$row = array();
		$row['data'] = "";
		
		$row['header'] = "<th>Assignment</th><th>Tutorial Lab ID</th>
				<th colspan='2'>Student</th><th>Date Due</th>
				<th>Date Submitted</th><th>Points Possible</th><th colspan='2'>Points Earned</th>
				<th>Percent</th><th>Hours</th><th>Summary</th><th>Homework Set</th>";
		
		$student_id = $homework_view->get_student_id();
		$student_first_name = $homework_view->get_student_first_name();
		$student_last_name = $homework_view->get_student_last_name();
		$assignment_id = $homework_view->get_assignment_id();
		$assignment_name = $homework_view->get_assignment_name();
		$section_id = $homework_view->get_section_id();
		$tutorial_lab_id = $homework_view->get_tutorial_lab_id();
		
		$homework_id = $homework_view->get_homework_id();
		$date_submitted = $homework_view->get_date_submitted();
			
		if(!isset($date_submitted))
		{			
			$row['data'] = "<td>$assignment_name</td>
				<td>$tutorial_lab_id</td><td>$student_id</td>
				<td>$student_first_name&nbsp;&nbsp;$student_last_name</td>
				<td colspan='12'>Not Submitted</td>";
				
			return $row;
		}		
			
		$date_submitted = date("D, m/d/y", strtotime($date_submitted));
		
		$points_earned = $homework_view->get_points_earned();
		$graded = $homework_view->get_was_graded();	
		$hours = $homework_view->get_hours();
		$points_possible = $homework_view->get_points_possible();
		$percent = " - ";
		
		$date_due = $homework_view->get_date_due();		
		$date_due = date("D, m/d/y", strtotime($date_due));
	
		$filepath = $homework_view->get_filepath();
		
		$summary = $homework_view->get_lab_summary();
		$url = "$filepath/$summary";
		$summary_link = "<a href='$url' download class='assignment_link'>$summary</a>";
							
		$homework_set = "homework_set.zip";
		$url = "$filepath/$homework_set";
		$homework_set_link = "<a href='$url' download class='assignment_link'>$homework_set</a>";
		
		if($graded & ($points_possible > 0))
		{
			$percent = (100.0 * $points_earned)/$points_possible;
		}
		
		if(!$graded)
		{
			$actionID = $this->gradeHomework;
			
			$points_earned = "<input type='number' class='table-input' 
								name='grade_$homework_id' 						
								min='0' max='$points_possible' >
								
							<button class='table-button' 
								name='grade_homework' value='$homework_id' >
								Grade </button>";
								
			$change_grade = " ";
		}			
		else
		{
			$actionID = $this->changeGrade;
			
			$change_grade = "<input type='number' class='table-input' 
								name='grade_$homework_id' id='grade_$homework_id' 
								min='0' max='$points_possible' >
								
							<button class='table-button' 								
								name='grade_homework' value='$homework_id' >
								Change </button>";
		}
		
		$row['data'] = "<td>$assignment_name</td>
			<td>$tutorial_lab_id</td><td>$student_id</td>
			<td>$student_first_name&nbsp;&nbsp;$student_last_name</td>
			<td>$date_due</td><td>$date_submitted</td>
			<td class='center' id='points_possible_$homework_id'>$points_possible</td>
			<td class='center' id='points_earned_$homework_id' >$points_earned</td>
			<td class='center' id='change_grade_$homework_id' >$change_grade</td>
			<td class='center' id='percent_$homework_id' >$percent</td>
			<td>$hours hours</td>				
			<td>$summary_link</td>
			<td>$homework_set_link</td>";		

		return $row;		
	}


	public function displayStudentHomeworkRow($homework_view)
	{		
		$row = array();
		$row['data'] = "";
		
		$row['header'] = "<th>Assignment</th>
				<th>Tutorial Lab ID</th><th>Date Due</th>
				<th>Date Submitted</th><th>Points Possible</th><th>Points Earned</th>
				<th>Percent</th><th>Hours</th><th>Summary</th><th>Homework Set</th>";
				
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
		$points_possible = $homework_view->get_points_possible();
		$percent = 0.0;
		
		if($graded & ($points_possible > 0))
		{
			$percent = (100.0 * $points_earned)/$points_possible;
		}
		else
		{
			$percent = " - ";
		}
		
		$hours = $homework_view->get_hours();			
		$date_submitted = $homework_view->get_date_submitted();	
		$date_due = $homework_view->get_date_due();		
		$date_due = date("D, m/d/y", strtotime($date_due));
		
		if(!isset($date_submitted))
		{
			$actionID = $this->submitHomework;
			
			$date_submitted = "<button type='button' class='table-button' 								
								name='submit_homework' value='$homework_id' 								
								onclick='homeworkActions($homework_id, $actionID);' >
								Submit</button>";
		}
		else
		{
			$date_submitted = date("D, m/d/y", strtotime($date_submitted));
		}
			
		$filepath = $homework_view->get_filepath();
		$url = "$filepath/$summary";
		$summary_link = "<a href='$url' download class='assignment_link'>$summary</a>";
		$homework_set = "homework_set.zip";
		$url = "$filepath/$homework_set";
		$homework_set_link = "<a href='$url' download class='assignment_link'>$homework_set</a>";
						
		$row['data'] = "<td>$assignment_name</td>
			<td>$tutorial_lab_id</td>
			<td>$date_due</td>
			<td id='submit_$homework_id' >$date_submitted</td>
			<td class='center'>$points_possible</td>
			<td class='center'>$points_earned</td>
			<td class='center'>$percent</td>
			<td>$hours hours</td>
			<td>$summary_link</td>
			<td>$homework_set_link</td>";

		return $row;

	}


	
}
 
 
?>