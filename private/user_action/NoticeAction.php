<?php

class NoticeAction
{	
	public function __construct() { }

	public function processWriteNoticeForm($mdb_control, &$error_array)
	{		
		$fileActions = new FileAction();
		$from_member_id = $_POST['from_member_id'];		
		$to_section_id = $_POST['to_section_id']; 
		$to_member_id = $_POST['to_member_id'];
		$notice_subject = $_POST['notice_subject'];
		$notice_text = $_POST['notice_text'];		
		//$response_to_notice_id = null;  
		
		// convert dates to mysql format
		$date_sent = $_POST['date_sent'];	
		$mysql_date_sent = date('Y-m-d H:i:s', strtotime($date_sent));		
		
		// test that the input meets requirements		
		$sucess = true;
		$this->verifyInput($notice_subject, $notice_text, $to_section_id, 
							$to_member_id, $error_array);
							
		if(!$sucess) 
		{ 
			$error_array[] = "<h2>Sorry, the Notice could not be sent.</h2>";
			return false; 
		}
		
		// save the new notice to the database
		
		// sanitize text box inputs for safety
		$db_con = get_db_connection();		
		$str = stripslashes(strip_tags(trim($notice_subject)));
		$notice_subject = mysqli_real_escape_string($db_con, $str);	
		$str = stripslashes(strip_tags(trim($notice_text)));
		$notice_text = mysqli_real_escape_string($db_con, $str);
				
		$notice_controller = $mdb_control->getController("notice");
		$notice = new Notice();		
		$notice_id = null; 
		//$flag_for_review = false;
		
		// save the notice data
		
		$notice->initialize($notice_id, $from_member_id, $mysql_date_sent, 
							$notice_subject, $notice_text);
					
		$sucess = $notice_controller->saveNew($notice);		
		
		if(!$sucess) 
		{ 
			$error_array[] = "<h2>Sorry, the Notice could not be sent.</h2>";
			return false; 
		}
		
		$notice_id = $notice->get_notice_id(); 	
		$year = date("Y");
		$uploads_dir = "attachments/notice/$year/id_$notice_id";		
		
		// save any notice attachments
		
		if(isset($_FILES["attachments"]))
		{	
			$sucess = $fileActions->processFileUploads("notice", $notice_id, 
									$uploads_dir, $mdb_control, $error_array);
			
			if(!$sucess) 
			{ 
				$notice_controller->deleteFromDatabase($notice);
				$fileActions->deleteDirectory($uploads_dir);
				return false; 				
			}
		}
				
		// send the notice (by saving destination info to database)		
		$sucess = $this->sendToDestinations($notice_id, $to_section_id, 
											$to_member_id, $mdb_control);
		
		if(!$sucess) 
		{ 
			$error_array[] = "<h2>Sorry, the Notice could not be sent.</h2>";
			$notice_controller->deleteFromDatabase($notice);
			$fileActions->deleteDirectory($uploads_dir);
			return false; 
		}
		
		return $sucess;				
	}



	public function sendToDestinations($notice_id, $to_section_id, $to_member_id, $mdb_control)
	{
		$sucess = true;
		$to_section_controller;
		$notice_to_section;
		$to_member_controller;
		$notice_to_member;
		
		if(!empty($to_section_id))
		{			
			$to_section_controller = $mdb_control->getController("notice_to_section");
			$notice_to_section = new NoticeToSection();
			$notice_to_section->initialize($notice_id, $to_section_id);
			$sucess = $to_section_controller->saveNew($notice_to_section);
			
			if(!$sucess) 
			{ 
				return false; 
			}
		}
		
		if(!empty($to_member_id))
		{
			$to_member_controller = $mdb_control->getController("notice_to_member");
			$notice_to_member = new NoticeToMember();
			$notice_to_member->initialize($notice_id, $to_member_id);
			$sucess = $to_member_controller->saveNew($notice_to_member);
			
			if(!$sucess) 
			{ 
				if(!empty($to_section_id))
					{ $to_section_controller->deleteFromDatabase($notice_to_section); }
				
				return false; 
			}
		}
		
		return $sucess;
	}


	public function verifyInput($notice_subject, $notice_text, $to_section_id, 
							$to_member_id, &$error_array)
	{
		$sucess = true;
		
		if (!preg_match("/^[a-zA-Z0-9 .',&_\-]*$/", $notice_subject)) 
		{
			$error_array[] = "<p>Subjects can only contain letters, numbers, spaces, 
						and the following characters .',-_&</p>";  
			$sucess = false;
		}
		
		if (empty($to_section_id) && empty($to_member_id)) 
		{
			$error_array[] = "<p>Please select a section and/or member to 
						receive the notice.</p>";   
			$sucess = false;
		}
		
		if (empty($notice_subject)) 
		{
			$error_array[] = "<p>A Subject is required for the notice.</p>";   
			$sucess = false;
		}
		
		if (empty($notice_text)) 
		{
			$error_array[] = "<p>A Message is required for the notice.</p>";   
			$sucess = false;
		}
		
		return $sucess;
	}
	
	
	public function returnURL()
	{
		$url = "";
		
		switch($_SESSION['member_type'])
		{
			case "professor":
				$url = "professor-home-page.php?notices=page";
				break;
			case "student":
				$url = "student-home-page.php?notices=page";
				break;
			case "administrator":
				$url = "administrator-home-page.php?notices=page";
				break;
		}
			
		return $url;
	}
	
	
	public function getSectionList($displayUtility, $sectionDisplay, $mdb_control)
	{
		$sectionList = "";
		
		switch($_SESSION['member_type'])
		{
			case "professor":
				$sectionList = $displayUtility->getListSectionIDNames_ByProfessor(
						$sectionDisplay, $_SESSION['professor_id'], $mdb_control);	
				break;
			case "student":
				$sectionList = $displayUtility->getListSectionIDNames_ByStudent(
						$sectionDisplay, $_SESSION['student_id'], $mdb_control);
				break;
			case "administrator":
				$sectionList = $displayUtility->getListSectionIDNames_All($mdb_control);
				break;
		}
			
		return $sectionList;
		
	}
	
	
	public function getToSectionID()
	{
		$to_section_id = "";
		
		if (isset($_POST['to_section_id']))
		{
			$to_section_id = $_POST['to_section_id']; 
		}
		
		return $to_section_id;
	}


	public function getToMemberID()
	{
		$to_member_id = "";
		
		if (isset($_POST['to_member_id']))
		{
			$to_member_id = $_POST['to_member_id']; 
		}
		
		return $to_member_id;
	}
	
	
	public function getNoticeSubject()
	{
		$notice_subject = "";
		
		if (isset($_POST['notice_subject']))
		{
			$notice_subject = $_POST['notice_subject']; 
		}
		
		return $notice_subject;
	}


	public function getNoticeText()
	{
		$notice_text = "";
		
		if (isset($_POST['notice_text']))
		{
			$notice_text = $_POST['notice_text']; 
		}
		
		return $notice_text;
	}

	
	public function getResponseToNoticeID()
	{
		$response_to_notice_id = "";
		
		if (isset($_POST['response_to_notice_id']))
		{
			$response_to_notice_id = $_POST['response_to_notice_id']; 
		}
		
		return $response_to_notice_id;
	}
	
	
	public function flagNoticeForReview($notice_id, $mdb_control)
	{
		// feature to be added at a later date		
	}
	
	
}


?>

