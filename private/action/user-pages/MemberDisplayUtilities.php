<?php

class MemberDisplayUtilities
{	
	public function __construct() {}
	
	
	public function displayDateTime($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date_time = date("m/d/y g:i A", $time);
			return $formated_date_time;
		}		
		
		return null;
	}
	
	
	public function displayDate($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date = date("m/d/y", $time);
			return $formated_date;
		}		
		
		return null;
	}
	
	
	public function displayBoolean($oneZero)
	{
		if(($oneZero == 1) || ($oneZero == true))
		{
			return "Yes";
		}
		else
		{
			return "No";
		}			
	}
	
	
	public function displaySectionStudentRow($section_list_of_students_view)
	{
		$section_id = $section_list_of_students_view->get_section_id();
		$section_name = $section_list_of_students_view->get_section_name();
		$student_id = $section_list_of_students_view->get_student_id();
		$student_first_name = $section_list_of_students_view->get_student_first_name();
		$student_last_name = $section_list_of_students_view->get_student_last_name();
		$school_name = $section_list_of_students_view->get_school_name();
		$start_date = $section_list_of_students_view->get_start_date();
		$start_date = $this->displayDate($start_date);
		$end_date = $section_list_of_students_view->get_end_date();
		$end_date = $this->displayDate($end_date);
		
		echo "<tr><td>$section_id&nbsp:&nbsp$section_name</td><td>$student_id</td><td>$student_first_name&nbsp&nbsp$student_last_name</td><td>$school_name</td><td>$start_date</td><td>$end_date</td></tr>";
	}


	public function displaySectionRow($section_view)
	{
		$section_id = $section_view->get_section_id();
		$section_name = $section_view->get_section_name();
		$professor_first_name = $section_view->get_professor_first_name();
		$professor_last_name = $section_view->get_professor_last_name();
		$school_name = $section_view->get_school_name();
		$start_date = $section_view->get_start_date();
		$start_date = $this->displayDate($start_date);
		$end_date = $section_view->get_end_date();
		$end_date = $this->displayDate($end_date);
		
		echo "<tr><td>$section_id&nbsp:&nbsp$section_name</td><td>$professor_first_name&nbsp&nbsp$professor_last_name</td><td>$school_name</td><td>$start_date</td><td>$end_date</td></tr>";
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