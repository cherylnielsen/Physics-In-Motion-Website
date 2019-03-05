<?php

class NoticeDisplay
{
	private $displayUtility;
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
	}
	
	
	public function displayNoticeSummary($professor_id, $section_list, $mdb_control)
	{
		echo "<div class='overflow'><table class='summary'><tr><th colspan='3'>Notice Summary</th></tr>";
		echo "<tr><th>Notice Type</th><th>Number of Notices</th></tr>";
		
		$notices = array();
		$notices = $this->getMemberInBoxNotices($professor_id, $mdb_control);
		$num_notices = count($notices);
		
		echo "<tr><td><a href=''>Member&nbsp:&nbspIn Box</a></td><td>$num_notices</td></tr>";
		
		$notices = array();
		$notices = $this->getMemberSentNotices($professor_id, $mdb_control);
		$num_notices = count($notices);		
		
		echo "<tr><td><a href=''>Member&nbsp:&nbspSent</a></td><td>$num_notices</td></tr>";
		
		$numSections = count($section_list);
		
		for($i = 0; $i < $numSections; $i++)
		{
			$section_id = $section_list[$i]->get_section_id();
			$section_name = $section_list[$i]->get_section_name();
			
			$notices = array();
			$notices = $this->getSectionNotices($section_id, $mdb_control);
			$num_notices = count($notices);
			
			echo "<tr><td><a href=''>Section $section_id&nbsp:&nbsp$section_name</a></td><td>$num_notices</td></tr>";
		}
		
		echo "</table></div>";
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
				$notice_list = $this->getSectionNotices($section_id, $mdb_control);
				$num_notices = count($notice_list);
				
				if($num_notices > 0)
				{
					echo "<tr><th>Date</th><th>Notice ID</th><th>Response to Notice ID</th>
						<th>From Name</th><th>From Member Type</th>
						<th>Subject</th><th>Text</th><th>Flag For Review</th><th>Attachments</th></tr>";
						
					for($j = 0; $j < $num_notices; $j++)
					{	
						$attachments = array();
						$notice_id = $notice_list[$j]->get_notice_id();
						$attachments = $this->getNoticeAttachments($notice_id, $mdb_control);
						$this->displayUtility->displayNoticeRow($notice_list[$j], $attachments);
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
	

	// Gets the notices from the database received by this section.
	public function getSectionNotices($to_section_id, $mdb_control)
	{
		$notices_to_section = array();		
		$controller = $mdb_control->getController("notice_to_section");
		$notices_to_section = $controller->getByAttribute("to_section_id", $to_section_id);
		
		$num_notices = count($notices_to_section);
		$notice_list = array();	
		$controller = $mdb_control->getController("notice_view");
		
		for($i = 0; $i < $num_notices; $i++)
		{
			$notice_id = $notices_to_section[$i]->get_notice_id();
			$notice = array();
			$notice = $controller->getByAttribute("notice_id", $notice_id);
			
			if(count($notice) == 1)
			{
				$notice_list[] = $notice[0];
			}
		}
		
		return $notice_list;
	}
	
	
	// tests if a notice is sent to a section instead of being sent to a member
	public function isNoticeToSection($notice_id, $mdb_control)
	{
		$notices_to_section = array();		
		$controller = $mdb_control->getController("notice_to_section");
		$notices_to_section = $controller->getByAttribute("notice_id", $notice_id);
		
		$num_notices = count($notices_to_section);
		$is_to_section = ($num_notices >= 1 ? true : false);
		
		return $is_to_section;
	}
	
	
	public function displayMemberInBoxNoticeTable($notice_list, $mdb_control)
	{
		echo "<table class='section-membership-table'>
				<tr><th colspan='5'>Member Notice In Box</th></tr>";
				
		$num_notices = count($notice_list);
		
		if($num_notices > 0)
		{
			echo "<tr><th>Date</th><th>Notice ID</th><th>Response to Notice ID</th>
						<th>From Name</th><th>From Member Type</th>
						<th>Subject</th><th>Text</th><th>Flag For Review</th><th>Attachments</th></tr>";
			
			for($i = 0; $i < $num_notices; $i++)
			{
				$attachments = array();
				$notice_id = $notice_list[$i]->get_notice_id();
				$attachments = $this->getNoticeAttachments($notice_id, $mdb_control);
				$this->displayUtility->displayNoticeRow($notice_list[$i], $attachments);
			}
		}
		else
		{
			echo "<tr><th colspan='7'>No notices received from members yet.</th></tr>";
		}
		
		echo "</table>";
	}
	
	
	public function displayMemberSentNoticeTable($notice_list, $mdb_control)
	{
		echo "<table class='section-membership-table'>
				<tr><th colspan='5'>Member Notices Sent</th></tr>";
				
		$num_notices = count($notice_list);
		
		if($num_notices > 0)
		{
			echo "<tr><th>Section</th><th>Professor</th><th>School</th><th>Start Date</th><th>End Date</th></tr>";
			
			for($i = 0; $i < $num_notices; $i++)
			{
				$notice_id = $notice_list[$i]->get_notice_id();
				$is_to_section = $this->isNoticeToSection($notice_id, $mdb_control);
				
				if(!$is_to_section)
				{
					$attachments = array();
					$attachments = $this->getNoticeAttachments($notice_id, $mdb_control);
					$this->displayUtility->displayNoticeRow($notice_list[$i], $attachments);
				}
			}
		}
		else
		{
			echo "<tr><th colspan='7'>No notices sent to members yet.</th></tr>";
		}
		
		echo "</table>";
	}
	
	
		// Gets all notices from the database sent by this member.
	public function getMemberSentNotices($from_member_id, $mdb_control)
	{
		$notices_sent = array();
		$notice_list = array();	
		$controller = $mdb_control->getController("notice_view");
		$notice_list = $controller->getByAttribute("from_member_id", $from_member_id);
		$num_notices = count($notice_list);
		
		for($i = 0; $i < $num_notices; $i++)
		{
			$notice_id = $notice_list[$i]->get_notice_id();
			$is_to_section = $this->isNoticeToSection($notice_id, $mdb_control);
			
			if(!$is_to_section) 
			{
				$notices_sent[] = $notice_list[$i];
			}
		}
		
		return $notices_sent;
	}
	
	
	// Gets all notices from the database sent to this member.
	public function getMemberInBoxNotices($to_member_id, $mdb_control)
	{
		$notices_to_member = array();		
		$controller = $mdb_control->getController("notice_to_member");
		$notices_to_member = $controller->getByAttribute("to_member_id", $to_member_id);
		
		$num_notices = count($notices_to_member);
		$notice_list = array();	
		$controller = $mdb_control->getController("notice_view");
		
		for($i = 0; $i < $num_notices; $i++)
		{
			$notice_id = $notices_to_member[$i]->get_notice_id();
			$notice = array();
			$notice = $controller->getByAttribute("notice_id", $notice_id);
			
			if(count($notice) == 1)
			{
				$notice_list[] = $notice[0];
			}
		}
		
		return $notice_list;
	}
	
	
	// Gets all attachments from the database for this notice id.
	public function getNoticeAttachments($notice_id, $mdb_control)
	{
		$attachment_list = array();
		$controller = $mdb_control->getController("notice_attachment");
		$attachment_list = $controller->getByAttribute("notice_id", $notice_id);
		
		return $attachment_list;
	}
	
	
	public function displayNoticeRow($notice_view, $attachments)
	{
		$date_sent = $notice_view->get_date_sent();
		$date_sent = $this->displayDateTime($date_sent);
		$notice_id = $notice_view->get_notice_id();		
		$response_to_notice_id = $notice_view->get_response_to_notice_id();
		$notice_subject = $notice_view->get_notice_subject();
		$notice_text = $notice_view->get_notice_text();
		$from_member_id = $notice_view->get_from_member_id();
		$from_first_name = $notice_view->get_from_first_name();
		$from_last_name = $notice_view->get_from_last_name();
		$from_member_type = $notice_view->get_from_member_type();
		$flag_for_review = $notice_view->get_flag_for_review();
		
		echo "<tr>";
		
		echo "<td>$date_sent</td><td>$notice_id</td><td>$response_to_notice_id</td><td>$from_first_name&nbsp&nbsp$from_last_name</td><td>$from_member_type</td><td>$notice_subject</td><td>$notice_text</td><td>$flag_for_review</td>";
		
		$num_attachments = count($attachments);
		
		for($i = 0; $i < $num_attachments; $i++)
		{
			$attached = $attachments[$i]->get_attachment();
			echo "<td>$attached</td>";
		}
		
		echo "</tr>";
	}
	
}

?>