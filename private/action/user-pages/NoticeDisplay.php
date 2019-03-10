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
		echo "<table class='summary noticeSummary'><tr><th colspan='3'><h2>Notice Summary</h2></th></tr>";
		echo "<tr><th>Notice Type</th><th>Number of Notices</th></tr>";
		
		$notices = array();
		$notices = $this->getMemberInBoxNotices($professor_id, $mdb_control);
		$num_notices_inbox = count($notices);
		
		$notices = array();
		$notices = $this->getMemberSentNotices($professor_id, $mdb_control);
		$num_notices_sent = count($notices);		
		
		echo "<tr><td>Member&nbsp:&nbspIn Box&nbsp/&nbspSent</td>";
		echo "<td>In Box (" . $num_notices_inbox . ")&nbsp/&nbspSent (" . $num_notices_sent . ")</td></tr>";
		
		$numSections = count($section_list);
		
		for($i = 0; $i < $numSections; $i++)
		{
			$section_id = $section_list[$i]->get_section_id();
			$section_name = $section_list[$i]->get_section_name();
			
			$notices = array();
			$notices = $this->getSectionNotices($section_id, $mdb_control);
			$num_notices = count($notices);
			
			echo "<tr><td>Section $section_id&nbsp:&nbsp$section_name</td>
					<td class='center'>$num_notices</td></tr>";
		}
		
		echo "</table>";
	}
	
	
	public function displaySectionNoticeTable($section_list, $mdb_control)
	{
		echo "<table class='notice-table'>
				<tr><th colspan='7'><h2>Section Notices</h2></th></tr>";
				
		$number_of_sections = count($section_list);
		
		if($number_of_sections > 0)
		{			
			for($i = 0; $i < $number_of_sections; $i++)
			{
				$section_id = $section_list[$i]->get_section_id();
				$section_name = $section_list[$i]->get_section_name();
				
				echo "<tr><th colspan='7' class='highlight'>
						<h2>Section $section_id&nbsp:&nbsp$section_name</h2></th></tr>";
				echo "<tr><th>Date</th><th>Subject</th><th>From</th>
						<th>Attachment</th><th>Flags</th></tr>";
				
				$notice_list = array();
				$notice_list = $this->getSectionNotices($section_id, $mdb_control);
				$num_notices = count($notice_list);
				
				if($num_notices > 0)
				{
					for($j = 0; $j < $num_notices; $j++)
					{	
						$attachments = array();
						$notice_id = $notice_list[$j]->get_notice_id();
						$attachments = $this->getNoticeAttachments($notice_id, $mdb_control);
						$this->displayNoticeRow($notice_list[$j], $attachments, $mdb_control);
					}	
				}
				else
				{
					echo "<tr><th colspan='10'>No Section $section_id Notices</th></tr>";
				}
			}
		}
		
		echo "</table>";
	}
	
	
	public function displayMemberInBoxNoticeTable($notice_list, $mdb_control)
	{
		$num_notices = count($notice_list);
		
		echo "<table class='notice-table'>
				<tr><th colspan='7'><h2>Member Notice In Box</h2></th></tr>";
		echo "<tr><th>Date</th><th>Subject</th><th>From</th>
				<th>Attachment</th><th>Flags</th></tr>";
		
		$num_notices = count($notice_list);
				
		if($num_notices === 0)
		{
			echo "<tr><th colspan='10'>No Notices</th></tr>";
		}
				
		for($i = 0; $i < $num_notices; $i++)
		{
			$attachments = array();
			$notice_id = $notice_list[$i]->get_notice_id();					
			$attachments = $this->getNoticeAttachments($notice_id, $mdb_control);
			$this->displayNoticeRow($notice_list[$i], $attachments, $mdb_control);
		}
		
		echo "</table>";
	}
	
	
	public function displayMemberSentNoticeTable($notice_list, $mdb_control)
	{			
		$num_notices = count($notice_list);
		
		echo "<table class='notice-table'>
				<tr><th colspan='7'><h2>Member Notices Sent</h2></th></tr>";
		echo "<tr><th>Date</th><th>Subject</th><th>Sent To</th>
				<th>Attachment</th><th>Flags</th></tr>";
				
		$num_notices = count($notice_list);
				
		if($num_notices === 0)
		{
			echo "<tr><th colspan='10'>No Notices</th></tr>";
		}
				
		for($i = 0; $i < $num_notices; $i++)
		{
			$attachments = array();
			$notice_id = $notice_list[$i]->get_notice_id();					
			$attachments = $this->getNoticeAttachments($notice_id, $mdb_control);
			$this->displayNoticeSentRow($notice_list[$i], $attachments, $mdb_control);
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
	
	
	public function getNoticeToMemberNames($notice_id, $mdb_control)
	{
		$names = "";
		$to_member_list = array();	
		
		$controller = $mdb_control->getController("notice_to_member");
		$to_member_list = $controller->getByAttribute("notice_id", $notice_id);
		$num_members = count($to_member_list);		
		$controller = $mdb_control->getController("member");
		
		for($i = 0; $i < $num_members; $i++)
		{
			$member_id = $to_member_list[$i]->get_to_member_id();
			$member = $controller->getByPrimaryKey("member_id", $member_id);
			$first = $member->get_first_name();
			$last = $member->get_last_name();
			$names = $first . "&nbsp&nbsp" . $last . ", ";
		}
		
		return $names;
	}

	
	public function getNoticeToSectionIDs($notice_id, $mdb_control)
	{
		$names = "";
		$to_section_list = array();		
		
		$controller = $mdb_control->getController("notice_to_section");
		$to_section_list = $controller->getByAttribute("notice_id", $notice_id);
		$num_sections = count($to_section_list);		
		$controller = $mdb_control->getController("section");
		
		for($i = 0; $i < $num_sections; $i++)
		{
			$section_id = $to_section_list[$i]->get_to_section_id();
			$section = $controller->getByPrimaryKey("section_id", $section_id);
			$section_name = $section->get_section_name();
			$names = "Section " . $section_id . "&nbsp:&nbsp" . $section_name . ", ";
		}
		
		return $names;
	}
	
	
	public function displayNoticeRow($notice_view, $attachments, $mdb_control)
	{
		$date_sent = $notice_view->get_date_sent();
		$date_sent = $this->displayUtility->displayDateTime($date_sent);
		$notice_id = $notice_view->get_notice_id();		
		$response_to_notice_id = $notice_view->get_response_to_notice_id();		
		$from_member_id = $notice_view->get_from_member_id();
		$from_first_name = $notice_view->get_from_first_name();
		$from_last_name = $notice_view->get_from_last_name();
		$from_member_type = $notice_view->get_from_member_type();
		
		$notice_subject = $notice_view->get_notice_subject();
		$notice_subject = substr($notice_subject, 0, 30);
		$notice_text = $notice_view->get_notice_text();
		$notice_text = substr($notice_text, 0, 30);
		
		$sent_to_members = $this->getNoticeToMemberNames($notice_id, $mdb_control);
		$sent_to_sections = $this->getNoticeToSectionIDs($notice_id, $mdb_control);
		
		$flag_for_review = $notice_view->get_flag_for_review();
		$flagged = $flag_for_review ? "flagged" : " &nbsp ";
		$num = count($attachments);
		$has_attachments = ($num >= 1) ? "attachments" : " &nbsp ";
		
		echo "<tr>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$date_sent</button></td>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$notice_subject ...</button></td>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$from_first_name&nbsp&nbsp$from_last_name</button></td>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$has_attachments</button></td>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$flagged</button></td>
				</tr>";	
		
		echo "<tr><td colspan='10'>";
				$this->displaySelectedNotice($notice_view, $attachments, $mdb_control);
		echo "</td></tr>";	
	}
	
	
	public function displayNoticeSentRow($notice_view, $attachments, $mdb_control)
	{
		$date_sent = $notice_view->get_date_sent();
		$date_sent = $this->displayUtility->displayDateTime($date_sent);
		$notice_id = $notice_view->get_notice_id();		
		$response_to_notice_id = $notice_view->get_response_to_notice_id();	
		
		$notice_subject = $notice_view->get_notice_subject();
		$notice_subject = substr($notice_subject, 0, 30);
		$notice_text = $notice_view->get_notice_text();
		$notice_text = substr($notice_text, 0, 30);
		
		$flag_for_review = $notice_view->get_flag_for_review();
		$flagged = $flag_for_review ? "flagged" : " &nbsp ";
		$num = count($attachments);
		$has_attachments = ($num >= 1) ? "attachments" : " &nbsp ";
		
		$sent_to_members = $this->getNoticeToMemberNames($notice_id, $mdb_control);
		$sent_to_sections = $this->getNoticeToSectionIDs($notice_id, $mdb_control);
		
		echo "<tr>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$date_sent</button></td>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$notice_subject ...</button></td>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$sent_to_members</button></td>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$has_attachments</button></td>
				<td><button class='showNoticeButton' onclick='showSelectedNotice($notice_id);'>
				$flagged</button></td>
				</tr>";	
		echo "<tr><td colspan='10'>";
				$this->displaySelectedNotice($notice_view, $attachments, $mdb_control);
		echo "</td></tr>";				
	}
	
	
	public function displaySelectedNotice($notice_view, $attachments, $mdb_control)
	{		
		$date_sent = $notice_view->get_date_sent();
		$date_sent = $this->displayUtility->displayDateTime($date_sent);
		$notice_id = $notice_view->get_notice_id();		
		$response_to_notice_id = $notice_view->get_response_to_notice_id();	
		
		$from_member_id = $notice_view->get_from_member_id();
		$from_first_name = $notice_view->get_from_first_name();
		$from_last_name = $notice_view->get_from_last_name();
		$from_member_type = $notice_view->get_from_member_type();
		
		$notice_subject = $notice_view->get_notice_subject();
		$notice_text = $notice_view->get_notice_text();
		$flag_for_review = $notice_view->get_flag_for_review();
		$flagged = $flag_for_review ? "flagged" : " &nbsp ";
		
		$sent_to_members = $this->getNoticeToMemberNames($notice_id, $mdb_control);
		$sent_to_sections = $this->getNoticeToSectionIDs($notice_id, $mdb_control);
		
		$num_attachments = count($attachments);
		$attachment_string = " ";
		
		for($i = 0; $i < $num_attachments; $i++)
		{
			$num = $i + 1;
			$attachment_string .=  "<a href=''>attachment_$num</a> ";
		}
		
		
		echo "<div id='notice$notice_id' class='selectedNotice'>
				<table class='selectedNotice'>";
				
		echo "<tr><td class='bold'>$notice_subject</td>
				<td class='flag-for-review right'>$flagged</td>
				<td class='right'>$date_sent</td></tr>
				<tr><td class='bold'>From: $from_first_name&nbsp&nbsp$from_last_name</td></tr>
				<tr><td colspan='3'>To: $sent_to_members $sent_to_sections</td></tr>
				<tr><td colspan='3'><hr></td></tr>
				<tr><td colspan='3'>$attachment_string</td></tr>
				<tr><td colspan='3'>$notice_text</td></tr>";
		
		echo "</table></div>";
		
	}
	
	
}

?>