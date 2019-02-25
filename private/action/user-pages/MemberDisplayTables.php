<?php

class MemberDisplayTables
{
	private $displayUtility;
	private $dataUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new MemberDisplayUtilities();
		$this->dataUtility = new MemberDataUtilities();
	}
	
	
	public function displayNoticeLists($member_id)
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
				$date = $this->displayUtility->displayDateTime($date);
				$subject = $notices_received[$i]->get_notice_subject();
				$text = $notices_received[$i]->get_notice_text();
				$text = substr($text, 0, 30) . ' ... ';
				
				echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$subject</td><td>$text</td></tr>";
				//echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$to_section_id</td><td>$subject</td><td>$text</td></tr>";
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
			echo "<tr><th>Select</th><th>Date</th><th>From Member</th><th>Subject</th><th>Message</th></tr>";
			//echo "<tr><th>Select</th><th>Date</th><th>From Member</th><th>To Section</th><th>Subject</th><th>Message</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$from_member_id = $notices_received[$i]->get_from_member_id();
				//$to_section_id = $notices_sent[$i]->get_to_section_id();
				$date = $notices_sent[$i]->get_date_sent();
				$date = $this->displayUtility->displayDateTime($date);
				$subject = $notices_sent[$i]->get_notice_subject();
				$text = $notices_sent[$i]->get_notice_text();
				$text = substr($text, 0, 30) . ' ... ';
				
				echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$subject</td><td>$text</td></tr>";
				//echo "<tr><td></td><td>$date</td><td>$from_member_id</td><td>$to_section_id</td><td>$subject</td><td>$text</td></tr>";
			}
		}
		
		echo "</table>";
	}
	
	
	public function displaySections_ByProfessor($professor_id)
	{
		
		
		echo "<table class='data-table'>
				<tr><th colspan='6'>Section Memberhips</th></tr>";
				
		$num = count($section_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='6'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section ID</th><th>Section Name</th><th>Professor</th><th>School</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$section_id = $section_list[$i]->get_section_id();
				$section_name = $section_list[$i]->get_section_name();
				$professor_name = $section_list[$i]->get_professor_name();
				$school_name = $section_list[$i]->get_school_name();
				$start_date = $section_list[$i]->get_start_date();
				$start_date = $this->displayUtility->displayDate($start_date);
				$end_date = $section_list[$i]->get_end_date();
				$end_date = $this->displayUtility->displayDate($end_date);
				
				echo "<tr><td>$section_id</td><td>$section_name</td><td>$professor_name</td><td>$school_name</td><td>$start_date</td><td>$end_date</td></tr>";
			}
		}
		
		echo "</table>";
	}
	

	
	public function displaySectionTable($section_list)
	{
		echo "<table class='data-table'>
				<tr><th colspan='6'>Section Memberhips</th></tr>";
				
		$num = count($section_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='6'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section ID</th><th>Section Name</th><th>Professor</th><th>School</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$this->displayUtility->displaySectionRow($section_list[$i]);
			}
		}
		
		echo "</table>";
	}
	
	
	public function displaySectionSummary_ByStudent($student_id, $section_list, $mdb_control)
	{
		$assignment_list = array();		
		$homework_list = array();
		$number_of_sections = count($section_list);
		
		if($number_of_sections > 0)
		{	
			echo "<table class='data-table'>";

			for($i = 0; $i < $number_of_sections; $i++)
			{
				$this->displayUtility->displaySectionRow($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$assignment_list = array();
				$assignment_list = $this->dataUtility->getSectionAssignments($section_id, $mdb_control);
				$number_of_assignments = count($assignment_list);
				
				$homework_list = array();
				$homework_list = $this->dataUtility->getSectionHomework_ByStudent($student_id, $section_id, $mdb_control);
				$number_of_homeworks = count($homework_list);
					
				for($j = 0; $j < $number_of_assignments; $j++)
				{					
					$this->displayUtility->displayAssignmentRow($assignment_list[$j]);
					$assignment_id = $assignment_list[$j]->get_assignment_id();
									
					for($k = 0; $k < $number_of_homeworks; $k++)
					{	$hmwk_assignment_id = $homework_list[$k]->get_assignment_id();
						
						if($hmwk_assignment_id == $assignment_id)
						{	$this->displayUtility->displayHomeworkRow($homework_list[$k]);
							break;
						}
					}					
				}// end assignment loop			
			} // end section loop
		}
		
		echo "</table>";
	}


	public function displaySectionSummary_ByProfessor($section_list, $assignment_list, $homework_list)
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
				//displaySectionRow(section_list
				
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

	
	
	
}

 
?>