<?php

class DisplayNotices
{
	private $displayUtility;
	private $dataUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new MemberDisplayUtilities();
		$this->dataUtility = new MemberDataUtilities();
	}
	
	
	public function displaySectionNoticeTable($section_list, $mdb_control)
	{
		echo "<table class='section-notice-table'>
				<tr><th colspan='5'>Section Notices</th></tr>";
				
		$number_of_sections = count($section_list);
		
		if($number_of_sections > 0)
		{
			echo "<tr><th>Section</th><th>Student ID</th><th>Student Name</th><th>School</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $number_of_sections; $i++)
			{
				$this->displayUtility->displaySectionRow($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$notice_list = array();
				$notice_list = $this->dataUtility->getSectionNotices($section_id, $mdb_control);
				$number_of_notices = count($notice_list);
				
				for($j = 0; $j < $number_of_notices; $j++)
				{					
					$this->displayUtility->displayNoticeRow($notice_list[$j]);
				}				
			}
		}
		
		echo "</table>";
	}
	
	
	
	public function displayMemberInBoxNoticeTable($section_list, $mdb_control)
	{
		echo "<table class='section-membership-table'>
				<tr><th colspan='5'>Member Notice In Box</th></tr>";
				
		$num = count($section_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section</th><th>Professor</th><th>School</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$this->displayUtility->displaySectionRow($section_list[$i]);
			}
		}
		
		echo "</table>";
	}
	
	
	public function displayMemberSentNoticeTable($section_list, $mdb_control)
	{
		echo "<table class='section-membership-table'>
				<tr><th colspan='5'>Member Notices Sent</th></tr>";
				
		$num = count($section_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section</th><th>Professor</th><th>School</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$this->displayUtility->displaySectionRow($section_list[$i]);
			}
		}
		
		echo "</table>";
	}
	
	
	
}

?>