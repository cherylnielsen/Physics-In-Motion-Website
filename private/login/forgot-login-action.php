<?php

require_once('login-utilities.php');
require_once('register-utilities.php'); 
	
If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$register = new RegisterUtilities();
	$form_errors = array();
	
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$email = $_POST['email'];
	$school = $_POST['school'];
	$member_type = $_POST['member_type'];
	
	$question_1 = $_POST['question_1'];
	$answer_1 = $_POST['answer_1'];
	$question_2 = $_POST['question_2'];
	$answer_2 = $_POST['answer_2'];
	
	// validate the member inputs
	$member_type = $register->validate_member_type($member_type, $form_errors);
	$register->validate_name($firstname, "First Name", $form_errors);
	$register->validate_name($lastname, "Last Name", $form_errors);
	$register->validate_name($school, "School Name", $form_errors);
	$register->validate_name($question_1, "Security Questions", $form_errors);
	$register->validate_name($answer_1, "Security Answers", $form_errors);
	$register->validate_name($question_2, "Security Questions", $form_errors);
	$register->validate_name($answer_2, "Security Answers", $form_errors);	
	$register->validate_password($_POST['password'], $_POST['password_confirm'], $form_errors);
	$ok_email = $register->validate_emails($_POST['email'], $_POST['email_confirm'], $form_errors);
	
	if(count($form_errors) != 0)
	{
		$register->display_errors($form_errors);
	}
	else
	{
		// *************  TO BE DONE **************  TO BE DONE  ******************
		
		
		// Find the member in the database
		//$ok_personal_information = ?? ($firstname, $lastname, $email, $school, $member_type, $mdb_control);	
		
		
		if(!$ok_personal_information)
		{
			echo'<div class="form-errors">
					<p>Sorry, the personal information did not match our records.</p>
				</div>';
		}
		else
		{
			// *************  TO BE DONE **************  TO BE DONE  ******************
			
			
			// Check that the member security questions and answers match the found member's records.
			// $member_id = found member
			//$ok_question_1 = ?? ($member_id, $question_1, $answer_1, $mdb_control);
			//$ok_question_2 = ?? ($member_id, $question_2, $answer_2, $mdb_control);
			
			if($ok_question_1 && $ok_question_2)
			{
				// Redirect the new member to the change of login page
				$url = "login-register-page.php?form_type=changelogin";
				header("Location: $url");
				exit();
				
			}
			else
			{
				echo'<div class="form-errors">
					<p>Sorry, the security questions did not match our records.</p>
					</div>';
			}			
		}
	}
	
}


?>