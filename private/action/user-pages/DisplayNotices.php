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
				<tr><th colspan='7'>Section Notices</th></tr>";
				
		$number_of_sections = count($section_list);
		
		if($number_of_sections > 0)
		{			
			for($i = 0; $i < $number_of_sections; $i++)
			{
				echo "<tr><th>Section</th><th>Professor</th><th>School</th>
						<th>Start</th><th>End</th></tr>";
						
				$this->displayUtility->displaySectionRow($section_list[$i]);
				$section_id = $section_list[$i]->get_section_id();
				
				$notice_list = array();
				$notice_list = $this->dataUtility->getSectionNotices($section_id, $mdb_control);
				$number_of_notices = count($notice_list);
				
				if($number_of_notices > 0)
				{
					echo "<tr><th>Date</th><th>Notice ID</th><th>Response to Notice ID</th>
						<th>From Name</th><th>From Member Type</th>
						<th>Subject</th><th>Text</th><th>Flag For Review</th></tr>";
						
					for($j = 0; $j < $number_of_notices; $j++)
					{					
						$this->displayUtility->displayNoticeRow($notice_list[$j]);
					}	
				}
				else
				{
					echo "<tr><th colspan='7'>No notices for this section.</th></tr>";
				}
			}
		}
		
		echo "</table>";
	}
	
	
	
	public function displayMemberInBoxNoticeTable($notice_list, $mdb_control)
	{
		echo "<table class='section-membership-table'>
				<tr><th colspan='5'>Member Notice In Box</th></tr>";
				
		$num = count($notice_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section</th><th>Professor</th><th>School</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$this->displayUtility->displayNoticeRow($notice_list[$i]);
			}
		}
		
		echo "</table>";
	}
	
	
	public function displayMemberSentNoticeTable($notice_list, $mdb_control)
	{
		echo "<table class='section-membership-table'>
				<tr><th colspan='5'>Member Notices Sent</th></tr>";
				
		$num = count($notice_list);
		
		if($num <= 0)
		{
			echo "<tr><td colspan='5'>Not currently in any sections</td></tr>";
		}
		else
		{
			echo "<tr><th>Section</th><th>Professor</th><th>School</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num; $i++)
			{
				$this->displayUtility->displayNoticeRow($notice_list[$i]);
			}
		}
		
		echo "</table>";
	}
	
	
	
}

?>