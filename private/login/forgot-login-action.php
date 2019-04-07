<?php

require_once('register-utilities.php'); 
$registerUtil = new RegisterUtilities();

require_once('change-login-utilities.php'); 
$changeUtil = new ChangeLoginUtilities(); 
	
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$form_errors = array();
	
	// process find member form part 1 of 3
	if(isset($_POST['find_member']))
	{	
		$ok = $changeUtil->validateMemberInput($registerUtil, $form_errors);
		
		if(count($form_errors) != 0)
		{
			$registerUtil->display_errors($form_errors);
		}
		else if($ok)
		{
			$found_member_id = $changeUtil->findMember($mdb_control, $registerUtil, $form_errors);
			
			if($found_member_id > 0)
			{
				if (session_status() == PHP_SESSION_NONE) 
				{
					session_start();
				}
				
				$_SESSION['found_member_id'] = $found_member_id;
				$_SESSION['part'] = "part2";
			}
			else
			{
				echo'<div class="form-errors">
						<p>Sorry, no matching member was found.</p>
					</div>';
			}			
		}
		else
		{
			echo'<div class="form-errors">
					<p>Sorry, no matching member was found.</p>
				</div>';
		}
	}
	
	
	// process find member form part 2 of 3
	if(isset($_POST['questions']))
	{		
		$form_errors = array();		
		// validate and sanitize the member inputs
		$changeUtil->checkQandA($_POST['answer_1'], $_POST['answer_2'], $_SESSION['found_member_id'], 
								$mdb_control, $registerUtil, $form_errors);	
		
		if(count($form_errors) != 0)
		{
			$registerUtil->display_errors($form_errors);
		}
		else
		{
			$_SESSION['part'] = "part3";
		}
	}
	
	
	// process find member form part 3 of 3
	if(isset($_POST['save_password']))
	{		
		$form_errors = array();		
		$registerUtil->validate_password($_POST['password'], $_POST['password_confirm'], $form_errors);
		
		if(count($form_errors) != 0)
		{
			$registerUtil->display_errors($form_errors);
		}
		else
		{
			// Save the new password to the database
			$db_connect = get_db_connection();
			$password = $_POST['password'];
			$success = $changeUtil->saveNewPassword($db_connect, 
						$_SESSION['found_member_id'], $password, $mdb_control);	
			
			if($success) 
			{
				$_SESSION['part'] = "part4";
			}
			else
			{
				echo'<div class="form-errors">
						<p>Sorry, the password could not be changed. 
							Please try again later.</p>
					</div>';
			}
		}	
	}
	
}
	
	

?>