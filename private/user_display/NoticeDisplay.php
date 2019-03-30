<?php

class NoticeDisplay
{
	private $displayUtility;
	private $filebase = "attachments";
	
	public function __construct() 
	{
		$this->displayUtility = new DisplayUtility();
	}
	
	
	public function displayNoticeSummary($member_id, $section_list, $mdb_control)
	{
		// 3 rows:
		// num notices today
		// num notices in last 7 days
		// total num notices
		// n cols: inbox, sent, section 1, section 2, ...
		
		$numOfNoticesArray = array();
		
		// in box notices 		
		$notices = array();
		$notices = $this->getMemberInBoxNotices($member_id, $mdb_control);		
		$numOfNoticesArray['inbox'] = $this->numberNotices($notices);
		
		// sent notices 		
		$notices = array();
		$notices = $this->getMemberSentNotices($member_id, $mdb_control);	
		$numOfNoticesArray['sent'] = $this->numberNotices($notices);	
		
		// table headings		
		$table_heading = "<table class='summary'>
				<tr><th colspan='10'><h2>Notice Summary</h2></th></tr>
				<tr><th> </th><th>In Box</th><th>Sent</th>"; 				
				
		// section notices & table headings continued
		
		$numSections = count($section_list);
		
		for($i = 0; $i < $numSections; $i++)
		{
			$section_id = $section_list[$i]->get_section_id();
			$table_heading = $table_heading . "<th>Section $section_id</th>";
			
			// section notices			
			$notices = array();
			$notices = $this->getSectionNotices($section_id, $mdb_control);						
			$numOfNoticesArray[$section_id] = $this->numberNotices($notices);
		}
		
		// display the table 
		
		$table_heading = "$table_heading</tr>";				
		echo "$table_heading";		
		
		$row_24hr = "<tr><th>Last 24 Hours</th><td>" . $numOfNoticesArray['inbox']['oneDay'] . "</td>
						<td>" . $numOfNoticesArray['sent']['oneDay'] . "</td>";
		$row_7day = "<tr><th>Last 7 Days</th><td>" . $numOfNoticesArray['inbox']['oneWeek'] . "</td>
						<td>" . $numOfNoticesArray['sent']['oneWeek'] . "</td>";
		$row_total = "<tr><th>Total Notices</th><td>" . $numOfNoticesArray['inbox']['total'] . "</td>
						<td>" . $numOfNoticesArray['sent']['total'] . "</td>";
		
		for($i = 0; $i < $numSections; $i++)
		{
			$section_id = $section_list[$i]->get_section_id();
			
			$day = $numOfNoticesArray[$section_id]['oneDay'];
			$week = $numOfNoticesArray[$section_id]['oneWeek'];
			$total = $numOfNoticesArray[$section_id]['total'];
			
			$row_24hr .= "<td>$day</td>";
			$row_7day .= "<td>$week</td>";
			$row_total .= "<td>$total</td>";
		}
			
		$row_24hr .= "</tr>";
		$row_7day .= "</tr>";
		$row_total .= "</tr>";
		
		echo "$row_24hr";
		echo "$row_7day";
		echo "$row_total";
		echo "</table>";
		
	}
	
	
	public function numberNotices($notice_list)
	{
		$number = array();
		$numNotices = count($notice_list);
		$numLast7Days = 0;	
		$numOneDay = 0;		
		$yesterday = new DateTime("-1 day");
		$weekAgo = new DateTime("-1 week");
		$today = new DateTime("now");
		
		//$date = $today->format('Y-m-d H:i:s');
		//echo "<br>today = $date<br>";
		
		for($i = 0; $i < $numNotices; $i++)
		{
			$sent = $notice_list[$i]->get_date_sent();		
			$dateSent = new DateTime($sent);
			
			if($yesterday <= $dateSent) { $numOneDay++; }
			if($weekAgo <= $dateSent) { $numLast7Days++; }
		}
		
		$number['oneDay'] = $numOneDay;
		$number['oneWeek'] = $numLast7Days;
		$number['total'] = $numNotices;
		
		return $number;
	}
	
	
	public function displaySectionNoticeTable($section_list, $mdb_control)
	{
		echo "<table class='notice-table'>
				<caption>Click on a notice to view.</caption>
				<tr><th colspan='7'><h2>Section Notices</h2></th></tr>";
				
		$number_of_sections = count($section_list);
		
		if($number_of_sections > 0)
		{			
			for($i = 0; $i < $number_of_sections; $i++)
			{
				$section_id = $section_list[$i]->get_section_id();
				$section_name = $section_list[$i]->get_section_name();
				
				echo "<tr><th colspan='7' class='sectionRowHeader'>
						<h2>Section $section_id&nbsp:&nbsp$section_name</h2></th></tr>
						<tr><th>Date</th><th>From</th><th>Subject</th>
						<th>Attachments</th><th>Flags</th></tr>";
				
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
						$this->displayNoticeRow("section", $notice_list[$j], $attachments, $mdb_control);
					}	
				}
				else
				{
					echo "<tr><td colspan='10'><h2>No Section $section_id Notices</h2></td></tr>";
				}
			}
		}
		
		echo "</table>";
	}
	
	
	public function displayMemberInBoxNoticeTable($notice_list, $mdb_control)
	{
		$num_notices = count($notice_list);
		
		echo "<table class='notice-table inbox'>
				<caption>Click on a notice to view.</caption>
				<tr><th colspan='7'><h2>Member Notice In Box</h2></th></tr>
				<tr><th>Date</th><th>From</th><th>Subject</th>
				<th>Attachments</th><th>Flags</th></tr>";
		
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
			$this->displayNoticeRow("inbox", $notice_list[$i], $attachments, $mdb_control);
		}
		
		echo "</table>";
	}
	
	
	public function displayMemberSentNoticeTable($notice_list, $mdb_control)
	{			
		$num_notices = count($notice_list);
		
		echo "<table class='notice-table'>
				<caption>Click on a notice to view.</caption>
				<tr><th colspan='7'><h2>Member Notices Sent</h2></th></tr>
				<tr><th>Date</th><th>To</th><th>Subject</th>
				<th>Attachments</th><th>Flags</th></tr>";
				
		$num_notices = count($notice_list);
				
		if($num_notices === 0)
		{
			echo "<tr><th colspan='7'>No Notices</th></tr>";
		}
				
		for($i = 0; $i < $num_notices; $i++)
		{
			$attachments = array();
			$notice_id = $notice_list[$i]->get_notice_id();					
			$attachments = $this->getNoticeAttachments($notice_id, $mdb_control);
			$this->displayNoticeRow("sent", $notice_list[$i], $attachments, $mdb_control);
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
	
	
	public function displayNoticeRow($notice_type, $notice_view, $attachments, $mdb_control)
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
		
		$flagged = $notice_view->get_flag_for_review();
		$number_attachments = count($attachments);
		$has_attachments = ($number_attachments >= 1) ? true : false;
		
		$divID = $notice_type . '_' . $notice_id;
		
		
		echo "<tr>";
		echo '<td><button class="showNoticeButton" 
				onclick="showSelectedNotice(\'' . $divID . '\')">' . 
				$date_sent . '</button></td>';	
						
		if($notice_type == "sent") // sent to someone else
		{
			echo '<td><button class="showNoticeButton" 
					onclick="showSelectedNotice(\'' . $divID . '\')">' . 
					$sent_to_members . ' ' . $sent_to_sections . '</button></td>';	
		}
		else // in box or section
		{
			echo '<td><button class="showNoticeButton" 
					onclick="showSelectedNotice(\'' . $divID . '\')">' . 
					$from_first_name . '&nbsp&nbsp' . $from_last_name . 
					'</button></td>';
		}
		
		echo '<td><button class="showNoticeButton" 
				onclick="showSelectedNotice(\'' . $divID . '\')">' . 
				$notice_subject . '</button></td>';	
		
		if($has_attachments)
		{
			echo '<td><button class="showNoticeButton" 
					onclick="showSelectedNotice(\'' . $divID . '\')">
					<span class="fas fa-paperclip"></span> &nbsp ' .
					$number_attachments . ' files</button></td>';
		}
		else
		{
			echo '<td><button class="showNoticeButton" 
					onclick="showSelectedNotice(\'' . $divID . '\')">
					&nbsp </button></td>';
		}
		
		if($flagged)
		{
			echo '<td><button class="showNoticeButton" 
					onclick="showSelectedNotice(\'' . $divID . '\')">
					<span class="fa fa-warning red">Possible inappropriate content!
					</span></button></td>';
		}
		else
		{
			echo '<td><button class="showNoticeButton" 
					onclick="showSelectedNotice(\'' . $divID . '\')">
					&nbsp </button></td>';
		}
		
		echo "</tr>";
		
		echo "<tr id='$divID' class='selectedNotice' >
				<td colspan='7'>";
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
		$flagged = $notice_view->get_flag_for_review();
		
		$sent_to_members = $this->getNoticeToMemberNames($notice_id, $mdb_control);
		$sent_to_sections = $this->getNoticeToSectionIDs($notice_id, $mdb_control);
		
		$num_attachments = count($attachments);
		$attachment_string = "";
						
		for($i = 0; $i < $num_attachments; $i++)
		{
			$filepath = $attachments[$i]->get_filepath();
			$filename = $attachments[$i]->get_filename();
			$url = $this->filebase . "/$filepath/$filename";
			$attachment_link = "<a href='$url' download class='notice_link'>
					$filename</a>";
			$attachment_string .= $attachment_link . ', ';
		}
		
		echo "<table class='selectedNotice'>";
				
		echo "<tr><td class='bold'>$notice_subject</td><td class='right'>$date_sent</td></tr>
				<tr><td class='bold'>From: $from_first_name&nbsp&nbsp$from_last_name</td>";
				
		if($flagged)
		{
			echo "<td class='flag-for-review right'>
					<span class='fa fa-warning red'>Under review for possible inappropriate content!
					</span></td>";
		}
		else
		{
			echo "<td class='flag-for-review right'>
					<button class='table-flag-button table-button' 
						name='notice-flag-for-review' value='$notice_id'>
						Report inappropriate content.
						<span class='fa fa-warning red'></span>
					</button></td>";
		}
						
		echo "</tr><tr><td colspan='2'>To: $sent_to_members, $sent_to_sections</td></tr>
				<tr><td colspan='2'><hr></td></tr>";
				
		if($num_attachments > 0)
		{
			echo "<tr><td colspan='2'><span class='fas fa-paperclip'></span>
					&nbsp $attachment_string</td></tr>
					<tr><td colspan='2'><hr></td></tr>";
		}
				
		echo "<tr><td colspan='2'><br>$notice_text<br><br></td></tr>";		
		echo "</table>";
		
	}
	
	
	
}

?>