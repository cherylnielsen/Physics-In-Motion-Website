<?php

class ChangeLoginUtilities
{
	
	public function __construct() 
	{
	}
	
	
	public function findMember($mdb_control, $registerUtil, &$form_errors)
	{		
		$member_id = -10;
		
		$first_name = trim($_POST['first_name']);
		$last_name = trim($_POST['last_name']);
		$email = trim($_POST['email']);
		$member_type = $_POST['member_type'];
		$school = trim($_POST['school']);
		
		$member_control = $mdb_control->getController("member");
		$member_list = array();
		$member_list = $member_control->getByAttributeSet("first_name", $first_name, "last_name", 
								$last_name, "email", $email, "member_type", $member_type);
								
		if(is_null($member_list) || (count($member_list) == 0))
		{
			return $member_id;
		}
		
		$controller;
		$id;
		
		switch ($member_type)
		{
			case "student":
				$controller = $mdb_control->getController("student");
				$id_type = "student_id";
				break;
			case "professor":
				$controller = $mdb_control->getController("professor");
				$id_type = "professor_id";
				break;
		}
		 
		 
		for($i = 0; $i < count($member_list); $i++)
		{
			$member_id = $member_list[$i]->get_member_id();
			$member_school = $controller->getByPrimaryKey($id_type, $member_id)->get_school_name();
			
			if(strcmp($school, $member_school) == 0)
			{
				return $member_id;
			}
		}
		
		return $member_id;
	}
	
	
	public function getReturnURL()
	{
		$url = "";
		$member_type = $_SESSION['member_type'];
		
		switch ($member_type)
		{
			case "student":
				$url = "student-home-page.php";
				break;
			case "professor":
				$url = "professor-home-page.php";
				break;
			case "administrator":
				$url = "admin-home-page.php";
				break;
		}
		
		//$homeURL = "http://localhost/Physics-in-Motion/" . $returnURL;
		
		return $url;		
	}
	
	public function validateMemberInput($registerUtil, &$form_errors)
	{	
		$success = true;
		
		// validate the member inputs
		$type_ok = $registerUtil->validate_member_type($_POST['member_type'], $form_errors);
		$first_ok = $registerUtil->validate_name($_POST['first_name'], "First Name", $form_errors);
		$last_ok = $registerUtil->validate_name($_POST['last_name'], "Last Name", $form_errors);
		$email_ok = $registerUtil->validate_emails($_POST['email'], $_POST['email'], $form_errors);
		$school_ok = $registerUtil->validate_name($_POST['school'], "School Name", $form_errors);
		
		if(!$type_ok || !$first_ok || !$last_ok || !$email_ok || !$school_ok)
		{
			$success = false;
		}
		
		return $success;
	}	
	
	
	public function getMemberInfo($mdb_control, $member_id)
	{
		$member = new Member();
		$member_control = $mdb_control->getController("member");
		$member = $member_control->getByPrimaryKey("member_id", $member_id);
		
		return $member;
	}


	public function getQandA($mdb_control, $member_id)
	{
		$security = $mdb_control->getController("security_question");
		$security_question = $security->getByAttribute("member_id", $member_id);
		$qAndA = array();
		
		for($i = 0; $i < count($security_question); $i++)
		{
			$qAndA[$i + 1]['question'] = $security_question[$i]->get_question();
			$qAndA[$i + 1]['answer'] = $security_question[$i]->get_answer();
		}
		
		return $qAndA;
	}


	public function checkQandA($answer_1, $answer_2, $member_id, $mdb_control, $registerUtil, &$form_errors)
	{
		$success = true;
		$qAndA = array();
		$qAndA = $this->getQandA($mdb_control, $member_id);
		
		$okA1 = $registerUtil->validate_name($answer_1, "Security Answer", $form_errors);
		$okA2 = $registerUtil->validate_name($answer_2, "Security Answer", $form_errors);
		
		if((count($qAndA) <= 0) || !$okA1 || !$okA2)
		{
			return false;
		}
			
		if((strcmp($qAndA[1]['answer'], $answer_1) !== 0) && 
				(strcmp($qAndA[2]['answer'], $answer_1) !== 0))
		{
			$form_errors[] = 'The answer to question 1 does not match our records. ';
			$success = false;
		}
		
		if((strcmp($qAndA[1]['answer'], $answer_2) !== 0) && 
				(strcmp($qAndA[2]['answer'], $answer_2) !== 0))
		{
			$form_errors[] = 'The answer to question 2 does not match our records. ';
			$success = false;
		}
		
		return $success;
	}

	
	public function saveNewPassword($db_connect, $member_id, $password, $mdb_control)
	{
		$password = mysqli_real_escape_string($db_connect, $password);
		$password = password_hash($password, PASSWORD_DEFAULT);
		
		$member = new Member();
		$member_control = $mdb_control->getController("member");
		$member = $member_control->getByPrimaryKey("member_id", $member_id);
		$member->set_member_password($password);
		$success = $member_control->updateAttribute($member, "member_password");
		
		return $success;
	}
	
	
	
}



?>