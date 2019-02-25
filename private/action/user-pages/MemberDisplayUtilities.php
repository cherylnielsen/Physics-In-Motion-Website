<?php

class MemberDisplayUtilities
{	
	public function __construct() {}
	
	
	public function displayDateTime($date_time)
	{
		$time = strtotime($date_time);
		$formated_date_time = date("m/d/y g:i A", $time);
		return $formated_date_time;
	}
	
	
	public function displayDate($date_time)
	{
		$time = strtotime($date_time);
		$formated_date = date("m/d/y", $time);
		return $formated_date;
	}
	
	
	public function displaySectionRow($section_view)
	{
		$section_id = $section_view->get_section_id();
		$section_name = $section_view->get_section_name();
		$professor_name = $section_view->get_professor_name();
		$school_name = $section_view->get_school_name();
		$start_date = $section_view->get_start_date();
		$start_date = $this->displayDate($start_date);
		$end_date = $section_view->get_end_date();
		$end_date = $this->displayDate($end_date);
		
		echo "<tr><td>$section_id</td><td>$section_name</td><td>$professor_name</td><td>$school_name</td><td>$start_date</td><td>$end_date</td></tr>";
	}

	
	public function displayAssignmentRow($assignment_view)
	{
		$section_id = $assignment_view->get_section_id();
		$assignment_id = $assignment_view->get_assignment_id();
		$lab_id = $assignment_view->get_tutorial_lab_id();
		$date_assigned = $assignment_view->get_date_assigned();
		$date_assigned = $this->displayDate($date_assigned);
		$date_due = $assignment_view->get_date_due();
		$date_due = $this->displayDateTime($date_due);
		$points_possible = $assignment_view->get_points_possible();
		$notes = $assignment_view->get_notes();
		$has_notes = isset($notes);
		
		echo "<tr><td>Section $section_id</td><td>Assignment $assignment_id</td><td>Lab $lab_id</td>
				<td>need to add lab name</td><td>Assigned $date_assigned</td>
				<td>Due $date_due</td><td>Points Possible $points_possible</td><td>Notes? $has_notes</td></tr>";
	}
	
	
	
	public function displayHomeworkRow($homework)
	{
		$assignment_id = $homework->get_assignment_id();
		$student_id = $homework->get_student_id();

		$summary = $homework->get_lab_summary();
		$has_summary = isset($summary);
		$data = $homework->get_lab_data();
		$has_data = isset($data);
		$graphs = $homework->get_graphs();
		$has_graphs = isset($graphs);
		$math = $homework->get_math();
		$has_math = isset($math);
		$hints = $homework->get_hints();
		$has_hints = isset($hints);
		$chat_session = $homework->get_chat_session();
		$has_chat_session = isset($chat_session);
		
		echo "<tr><td></td><td>Lab Summary? $has_summary</td><td>Data? $has_data</td><td>Graphs? $has_graphs</td>
				<td>Math? $has_math</td><td>Hints? $has_hints</td><td>Chat Session? $has_chat_session</td></tr>";
	}
	
	
}

 
?>