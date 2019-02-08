<?php

class Member_Display_Tables
{
	
	public function __construct() {}
	
	
	/***
	Converts the database date time string into a standard time, and then 
	into a pretty looking time format for display to the user.
	Input: $db_date_time = the date time string from the database 
			(yyyy-mm-dd hh:mm:ss in 24 hour time)
	Output: $formated_date_time = the pretty looking time format for display 
				(mm/dd/yy hh:mm PM)
	***/
	public function format_date_time($db_date_time)
	{
		$time = strtotime($db_date_time);
		$formated_date_time = date("m/d/y g:i A", $time);
		return $formated_date_time;
	}
	
	
	public function display_notice_table($notices_received, $notices_sent)
	{
		echo "<table class='data-table'>
				<tr><th colspan='6'>Notice Inbox</th></tr>";
				
		$num = count($notices_received);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='6'>No Notices Received</td></tr>";
		}
		else
		{
			echo "<tr><th>Select</th><th>Date</th><th>From Member</th><th>To Section</th><th>Subject</th><th>Message</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$from_member_id = $notices_received[$i]->get_from_member_id();
				$to_section_id = $notices_received[$i]->get_to_section_id();
				$date = $notices_received[$i]->get_date_sent();
				$date = $this->format_date_time($date);
				$subject = $notices_received[$i]->get_notice_subject();
				$text = $notices_received[$i]->get_notice_text();
				$text = substr($text, 0, 30) . ' ... ';
				
				echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$to_section_id</td><td>$subject</td><td>$text</td></tr>";
			}
		}
				
		echo "<tr><th colspan='6'>Notices Sent</th></tr>";
		
		$num = count($notices_sent);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='6'>No Notices Sent</td></tr>";
		}
		else
		{
			echo "<tr><th>Select</th><th>Date</th><th>From Member</th><th>To Section</th><th>Subject</th><th>Message</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$from_member_id = $notices_received[$i]->get_from_member_id();
				$to_section_id = $notices_sent[$i]->get_to_section_id();
				$date = $notices_sent[$i]->get_date_sent();
				$date = $this->format_date_time($date);
				$subject = $notices_sent[$i]->get_notice_subject();
				$text = $notices_sent[$i]->get_notice_text();
				$text = substr($text, 0, 30) . ' ... ';
				
				echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$to_section_id</td><td>$subject</td><td>$text</td></tr>";
			}
		}
		
		echo "</table>";
	}
	
	
	public function display_section_table($section_list)
	{
		echo "<table class='data-table'>
				<tr><th colspan='6'>Section Memberhips</th></tr>";
				
		$num = count($section_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='6'>Not in any Sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Select</th><th>Section ID</th><th>Section Name</th><th>Professor</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$section_id = $section_list[$i]->get_section_id();
				$section_name = $section_list[$i]->get_section_name();
				$professor_id = $section_list[$i]->get_professor_id();
				$start_date = $section_list[$i]->get_start_date();
				$start_date = $this->format_date_time($start_date);
				$end_date = $section_list[$i]->get_end_date();
				$end_date = $this->format_date_time($end_date);
				
				echo "<tr><td></td><td>$section_id</td><td>$section_name</td><td>$professor_id</td><td>$start_date</td><td>$end_date</td></tr>";
			}
		}
		
		echo "</table>";
	}

	
	public function display_assignment_table($assignment_list)
	{
		echo "<table class='data-table'>
				<tr><th colspan='8'>Section Assignments</th></tr>";
				
		$num = count($assignment_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='8'>No Assignments</td></tr>";
		}
		else
		{
			echo "<tr><th>Select</th><th>Section ID</th><th>Assignment ID</th><th>Lab ID</th>
					<th>Date Assigned</th><th>Date Due</th><th>Points Possible</th><th>Notes</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$section_id = $assignment_list[$i]->get_section_id();
				$assignment_id = $assignment_list[$i]->get_assignment_id();
				$lab_id = $assignment_list[$i]->get_lab_id();
				$date_assigned = $assignment_list[$i]->get_date_assigned();
				$date_assigned = $this->format_date_time($date_assigned);
				$date_due = $assignment_list[$i]->get_date_due();
				$date_due = $this->format_date_time($date_due);
				$points_possible = $assignment_list[$i]->get_points_possible();
				$notes = $assignment_list[$i]->get_notes();
				
				echo "<tr><td></td><td>$section_id</td><td>$assignment_id</td><td>$lab_id</td>
						<td>$date_assigned</td><td>$date_due</td><td>$points_possible</td><td>$notes</td></tr>";
			}
		}
		
		echo "</table>";
	}
	
	
	public function display_homework_table($homework_list)
	{
		echo "<table class='data-table'>
				<tr><th colspan='9'>Section Homeworks</th></tr>";
				
		$num = count($homework_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='9'>No Homework</td></tr>";
		}
		else
		{
			echo "<tr><th>Select</th><th>Assignment ID</th><th>Student ID</th><th>Lab Summary</th>
					<th>Data</th><th>Graphs</th><th>Math</th><th>Hints</th><th>Chat Session</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$assignment_id = $homework_list[$i]->get_assignment_id();
				$student_id = $homework_list[$i]->get_student_id();
				$lab_summary = $homework_list[$i]->get_lab_summary();
				$lab_data = $homework_list[$i]->get_lab_data();
				$graphs = $homework_list[$i]->get_graphs();
				$math = $homework_list[$i]->get_math();
				$hints = $homework_list[$i]->get_hints();
				$chat_session = $homework_list[$i]->get_chat_session();
				
				echo "<tr><td></td><td>$assignment_id</td><td>$student_id</td><td>$lab_summary</td>
						<td>$lab_data</td><td>$graphs</td><td>$math</td><td>$hints</td>
						<td>$chat_session</td></tr>";
			}
		}
		
		echo "</table>";
	}
	
	
	public function display_submission_table($submission_list)
	{
		echo "<table class='data-table'>
				<tr><th colspan='8'>Homework Submissions</th></tr>";
				
		$num = count($submission_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='8'>No Homework Submissions</td></tr>";
		}
		else
		{
			echo "<tr><th>Select</th><th>Assignment ID</th><th>Student ID</th><th>Date Submitted</th>
					<th>Points Earned</th><th>Graded?</th><th>Total Time</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$assignment_id = $submission_list[$i]->get_assignment_id();
				$student_id = $submission_list[$i]->get_student_id();
				$date_submitted = $submission_list[$i]->get_date_submitted();
				$date_submitted = $this->format_date_time($date_submitted);
				$points_earned = $submission_list[$i]->get_points_earned();
				$is_graded = $submission_list[$i]->get_is_graded();
				//answer = test ? true : false;
				$graded = $is_graded ? "Yes" : "No";
				$total_time = $submission_list[$i]->get_total_time();
				
				echo "<tr><td></td><td>$assignment_id</td><td>$student_id</td><td>$date_submitted</td>
						<td>$points_earned</td><td>$graded</td><td>$total_time</td></tr>";
			}
		}
		
		echo "</table>";
	}
	
	
	
}

 
?>