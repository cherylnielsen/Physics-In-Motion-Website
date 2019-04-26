<?php

class AdminRegistrationAction
{
	public function __construct() {}
	
	
	public function processForm($mdb_control)
	{
		$register = new RegisterUtilities();
		$form_errors = array();
		$success = true;
		
		$member_type = "administrator";
		// no school is saved for administrators
		$school = " ";
		
		// member info
		$firstname = isset($_POST['first_name']) ? $_POST['first_name'] : "" ;
		$lastname = isset($_POST['last_name']) ? $_POST['last_name'] : "" ;
		$email = isset($_POST['email']) ? $_POST['email'] : "" ;
		
		// login info
		$membername = isset($_POST['membername']) ? $_POST['membername'] : "" ;
		$password = isset($_POST['password']) ? $_POST['password'] : "" ;	
		
		// security info
		$question_1 = isset($_POST['question_1']) ? $_POST['question_1'] : "" ;
		$answer_1 = isset($_POST['answer_1']) ? $_POST['answer_1'] : "" ;
		$question_2 = isset($_POST['question_2']) ? $_POST['question_2'] : "" ;
		$answer_2 = isset($_POST['answer_2']) ? $_POST['answer_2'] : "" ;	
	
		// validate the member inputs
		
		$register->validate_name($firstname, "First Name", $form_errors);
		$register->validate_name($lastname, "Last Name", $form_errors);
		
		$register->validate_name($question_1, "Security Questions", $form_errors);
		$register->validate_name($answer_1, "Security Answers", $form_errors);
		$register->validate_name($question_2, "Security Questions", $form_errors);
		$register->validate_name($answer_2, "Security Answers", $form_errors);	
		
		$ok_pw = $register->validate_password($_POST['password'], 
								$_POST['password_confirm'], $form_errors);
		
		$ok_name = $register->validate_membername($_POST['membername'], 
							$_POST['membername_confirm'], $form_errors);
							
		$ok_email = $register->validate_emails($_POST['email'], 
							$_POST['email_confirm'], $form_errors);
	
		if($ok_name && $ok_email)
		{
			$register->uniqueness_test($email, $membername, $mdb_control, $form_errors);
		}
		
		if(count($form_errors) == 0)
		{
			// Save the data to the database
			$success = $register->register_new_member($firstname, 
					$lastname, $email, $school, 
					$member_type, $membername, $password, $mdb_control, 
					$question_1, $answer_1, $question_2, $answer_2);	
		}
		else
		{
			$success = false;
		}
		
		if($success)
		{
			$form_success = "<h2>SUCCESS: </h2>";
			$form_success .= "<p>The Members have been confirmed, 
						and their registrations are now complete.</p>";
								
			$homeURL = "http://localhost/Physics-in-Motion/" . $returnURL;
		
			echo "<script type='text/javascript'>
					window.location.href = $homeURL;
				</script>";
				
			echo "<h2 class='center'>$form_success</h2>";
			
			exit();
		}
		else
		{
			$form_errors = "<h2>ERROR: </h2>";
			
			foreach($error_array as $str)
			{
				$form_errors .= "<p>" . $str . "</p>";
			}
			
			$form_errors .= "<p>The administrator could not be registered.</p><br>";
		}
				
		$result = array();
		$result['success'] = $success;
		$result['form_errors'] = $form_errors;
		
		return $result;
	
}


?>