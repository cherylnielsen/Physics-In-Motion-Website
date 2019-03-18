<?php

class NoticeAction
{
	public function __construct() {}

	public function processWriteNoticeForm($mdb_control)
	{
		$sucess = true;
		
		$from_member_id = $_POST['from_member_id'];		
		$to_section_id = $_POST['to_section_id']; 
		$to_member_id = $_POST['to_member_id'];
		$notice_subject = $_POST['notice_subject'];
		$notice_text = $_POST['notice_text'];		
		$response_to_notice_id = $_POST['response_to_notice_id'];  
		// convert dates to mysql format
		$date_sent = $_POST['date_sent'];	
		$mysql_date_sent = date('Y-m-d H:i:s', strtotime($date_sent));				
				
		// test text box input for alpha-numeric character limits
		echo "<div class='form-errors' >";
		
		if (!preg_match("/^[a-zA-Z0-9 .',()&_\-]*$/", $notice_subject)) 
		{
			echo "<p>Subjects can only contain letters, numbers, spaces, 
					and the following characters .',-_&()</p>";  
			return false;
		}
		
		if (!preg_match("/^[a-zA-Z0-9 .';,()?!&%_\-]*$/", $notice_text)) 
		{
			echo "<p>Messages  can only contain letters, numbers, spaces, 
					and the following characters .';,-_()?!&%</p>";   
			return false;
		}
		
		echo "</div>";
		
		// sanitize text box inputs for safety
		$db_con = get_db_connection();		
		$str = stripslashes(strip_tags(trim($notice_subject)));
		$notice_subject = mysqli_real_escape_string($db_con, $str);	
		$str = stripslashes(strip_tags(trim($notice_text)));
		$notice_text = mysqli_real_escape_string($db_con, $str);
		
		//db_linked_files/assignment
		//$new_notes = ??;	
		// call function to test file types, etc.
		$attachments = null;
		
		
		$controller = $mdb_control->getController("notice");
		$notice = new Notice();		
		$notice_id = null; 
		$flag_for_review = false;
		
		$notice->initialize($notice_id, $from_member_id, $mysql_date_sent, 
							$notice_subject, $notice_text);
					
		$sucess = $controller->saveNew($notice);		
		if(!$sucess) { return false; }				
		$notice_id = $notice->get_notice_id(); 		
		
		
		if(isset($to_section_id))
		{
			if($to_section_id !== "")
			{
				$controller = $mdb_control->getController("notice_to_section");
				$notice_to_section = new NoticeToSection();
				$notice_to_section->initialize($notice_id, $to_section_id);
				$sucess = $controller->saveNew($notice_to_section);
				if(!$sucess) { return false; }
			}
		}
		
		if(isset($to_member_id))
		{
			if($to_member_id !== "")
			{
				$controller = $mdb_control->getController("notice_to_member");
				$notice_to_member = new NoticeToMember();
				$notice_to_member->initialize($notice_id, $to_member_id);
				$sucess = $controller->saveNew($notice_to_member);
				if(!$sucess) { return false; }
			}
		}
		
		if(isset($attachments))
		{			
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

