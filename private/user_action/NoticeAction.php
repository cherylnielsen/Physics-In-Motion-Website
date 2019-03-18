<?php

class NoticeAction
{
	public function __construct() {}

	public function processWriteNoticeForm($mdb_control)
	{
		$sucess = true;
		$controller = $mdb_control->getController("assignment");
		$assignment = new Assignment();
		
		$section_id = $_POST['section_id'];		
		$tutorial_lab_id = $_POST['tutorial_lab_id']; 
		$points_possible = $_POST['points_possible'];
		
		// convert dates to mysql format
		$date_sent = $_POST['date_sent'];	
		$mysql_date_sent = date('Y-m-d H:i:s', strtotime($date_sent));				
		$date_due = $_POST['date_due']; 		
		$mysql_date_due = date('Y-m-d H:i:s', strtotime($date_due));
				
		// test assignment_name for unsafe characters because it is input from text box
		$assignment_name = $_POST['assignment_name'];
		
		if (!preg_match("/^[a-zA-Z0-9 \-]*$/", $assignment_name)) 
		{
			echo "<p>Assignment Name can only contain letters, numbers, dashes, and white space.</p>";  
			return false;
		}
		
		// sanitize assignment_name because it is input from text box
		$db_con = get_db_connection();		
		$name = stripslashes(strip_tags(trim($assignment_name)));
		$assignment_name = mysqli_real_escape_string($db_con, $name);
		
		//db_linked_files/assignment
		//$new_notes = ??;	
		// call function to test file types, etc.
		$attachments = null;
		
		switch ($form_type)
		{
			case "edit_assignment":				
				$assignment_id = $_POST['assignment_id']; 
				
				$assignment->initialize($assignment_id, $section_id, $tutorial_lab_id, 
							$assignment_name, $mysql_date_sent, $mysql_date_due, 
							$points_possible, $attachments);
							
				$sucess = $controller->updateAll($assignment);
				break;
				
			case "add_assignment":
				$assignment_id = null; 
				
				$assignment->initialize($assignment_id, $section_id, $tutorial_lab_id, 
							$assignment_name, $mysql_date_sent, $mysql_date_due, 
							$points_possible, $attachments);
							
				$sucess = $controller->saveNew($assignment);
				break;
		}
		
		return $sucess;				
	}

	
	public function getToSectionID()
	{
		$to_section_id = "";
		
		if (isset($_POST['to_section_id']))
		{
			$to_section_id = $_POST['to_section_id']; 
		}
		else if (isset($_GET['to_section_id']))
		{
			$to_section_id = $_GET['to_section_id']; 
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
		else if (isset($_GET['to_member_id']))
		{
			$to_member_id = $_GET['to_member_id']; 
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
		else if (isset($_GET['notice_subject']))
		{
			$notice_subject = $_GET['notice_subject']; 
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
		else if (isset($_GET['notice_text']))
		{
			$notice_text = $_GET['notice_text']; 
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
		else if (isset($_GET['response_to_notice_id']))
		{
			$response_to_notice_id = $_GET['response_to_notice_id']; 
		}
		
		return $response_to_notice_id;
	}
	
	
	
}


?>

