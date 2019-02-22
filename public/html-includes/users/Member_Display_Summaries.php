<?php

class Member_Display_Summaries
{
	
	public function __construct() {}
	
	
	/***
	Converts the database date time string into a standard time, and then 
	into a pretty looking time format for display to the user.
	Input: $db_date_time = the date time string from the database 
			(yyyy-mm-dd hh:mm:ss in 24 hour time)
	Output: $formated_date_time = the pretty looking date and time 
			format for display (mm/dd/yy hh:mm PM)
	***/
	public function format_date_time($db_date_time)
	{
		$time = strtotime($db_date_time);
		$formated_date_time = date("m/d/y g:i A", $time);
		return $formated_date_time;
	}
	
	
	/***
	Converts the database date time string into a standard time, and then 
	into a pretty looking time format for display to the user.
	Input: $db_date_time = the date time string from the database 
			(yyyy-mm-dd hh:mm:ss in 24 hour time)
	Output: $formated_date_time = the pretty looking date format 
			for display (mm/dd/yy)
	***/
	public function format_date_only($db_date_time)
	{
		$time = strtotime($db_date_time);
		$formated_date = date("m/d/y", $time);
		return $formated_date;
	}
	
	
	public function display_notices_by_section($notices_received, $notices_sent)
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
			//echo "<tr><th>Select</th><th>Date</th><th>From Member</th><th>To Section</th><th>Subject</th><th>Message</th></tr>";
			echo "<tr><th>Select</th><th>Date</th><th>From Member</th><th>Subject</th><th>Message</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$from_member_id = $notices_received[$i]->get_from_member_id();
				//$to_section_id = $notices_received[$i]->get_to_section_id();
				$date = $notices_received[$i]->get_date_sent();
				$date = $this->format_date_time($date);
				$subject = $notices_received[$i]->get_notice_subject();
				$text = $notices_received[$i]->get_notice_text();
				$text = substr($text, 0, 30) . ' ... ';
				
				//echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$to_section_id</td><td>$subject</td><td>$text</td></tr>";
				echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$subject</td><td>$text</td></tr>";
			}
		}
				
		echo "<tr><th colspan='6'>Notices Sent</th></tr>";
		
		$num = count($notices_sent);
		
		if($num <= 0)
		{
			echo "<tr><th colspan='5'>No Notices Sent</td></tr>";
		}
		else
		{
			//echo "<tr><th>Select</th><th>Date</th><th>From Member</th><th>To Section</th><th>Subject</th><th>Message</th></tr>";
			echo "<tr><th>Select</th><th>Date</th><th>From Member</th><th>Subject</th><th>Message</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$from_member_id = $notices_received[$i]->get_from_member_id();
				//$to_section_id = $notices_sent[$i]->get_to_section_id();
				$date = $notices_sent[$i]->get_date_sent();
				$date = $this->format_date_time($date);
				$subject = $notices_sent[$i]->get_notice_subject();
				$text = $notices_sent[$i]->get_notice_text();
				$text = substr($text, 0, 30) . ' ... ';
				
				//echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$to_section_id</td><td>$subject</td><td>$text</td></tr>";
				echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$subject</td><td>$text</td></tr>";
			}
		}
		
		echo "</table>";
	}
	
	
	public function display_section_summary($section_list, $assignment_list, $homework_list, $submission_list)
	{
		$number_of_sections = count($section_list);
		$number_of_assignments = count($assignment_list);
		$number_of_homeworks = count($homework_list);
		$number_of_submissions = count($submission_list);
		
		if($number_of_sections > 0)
		{	
			echo "<table class='data-table'>";

			for($i = 0; $i < $number_of_sections; $i++)
			{
				$section_id = $section_list[$i]->get_section_id();
				$section_name = $section_list[$i]->get_section_name();
				$professor_id = $section_list[$i]->get_professor_id();
				$start_date = $section_list[$i]->get_start_date();
				$start_date = $this->format_date_only($start_date);
				$end_date = $section_list[$i]->get_end_date();
				$end_date = $this->format_date_only($end_date);
				
				echo "<tr><th colspan='10'>Section $section_id Summary</th></tr>";
				echo "<tr><td>Section $section_id</td><td>$section_name</td><td>Professor $professor_id</td>
						<td>Start $start_date</td><td>End $end_date</td></tr>";
				
				for($j = 0; $j < $number_of_assignments; $j++)
				{
					$assignment_section_id = $assignment_list[$j]->get_section_id();
					$assignment_id = $assignment_list[$j]->get_assignment_id();
					
					if($assignment_section_id == $section_id)
					{	$this->display_assignment_row($assignment_list[$j]);
					
						for($k = 0; $k < $number_of_homeworks; $k++)
						{	$hmwk_assignment_id = $homework_list[$k]->get_assignment_id();
							
							if($hmwk_assignment_id == $assignment_id)
							{	$this->display_homework_row($homework_list[$k]);
							}
						}
						
						for($k = 0; $k < $number_of_submissions; $k++)
						{	$sub_assignment_id = $submission_list[$k]->get_assignment_id();
							
							if($sub_assignment_id == $assignment_id)
							{	$this->display_submission_row($submission_list[$k]);
							}
						}
					}
				}// end assignment loop			
			} // end section loop
		}
		
		echo "</table>";
	}

	
	public function display_assignment_row($assignment)
	{
		$section_id = $assignment->get_section_id();
		$assignment_id = $assignment->get_assignment_id();
		$lab_id = $assignment->get_lab_id();
		$date_assigned = $assignment->get_date_assigned();
		$date_assigned = $this->format_date_only($date_assigned);
		$date_due = $assignment->get_date_due();
		$date_due = $this->format_date_time($date_due);
		$points_possible = $assignment->get_points_possible();
		$notes = $assignment->get_notes();
		$has_notes = isset($notes);
		
		echo "<tr><td>Section $section_id</td><td>Assignment $assignment_id</td><td>Lab $lab_id</td>
				<td>need to add lab name</td><td>Assigned $date_assigned</td>
				<td>Due $date_due</td><td>Points Possible $points_possible</td><td>Notes? $has_notes</td></tr>";
	}
	
	
	public function display_submission_row($submission)
	{
		$assignment_id = $submission->get_assignment_id();
		$student_id = $submission->get_student_id();
		$points_earned = $submission->get_points_earned();
		$total_time = $submission->get_total_time();
		
		$is_graded = $submission->get_was_graded();
		//answer = test ? true : false;
		$graded = $is_graded ? "Yes" : "No";
		
		$date_submitted = $submission->get_date_submitted();
		$submitted = isset($date_submitted) ? "Yes" : "No";
		
		if($submitted)
		{ 
			$date_submitted = $this->format_date_time($date_submitted);
		}
		else
		{
			$date_submitted = " ";
		}
		
		echo "<tr><td></td><td>Submitted $date_submitted</td><td>Points $points_earned</td>
				<td>Graded? $graded</td><td>$total_time Hours</td></tr>";
	}
	
	
	public function display_homework_row($homework)
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