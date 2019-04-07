<?php

require_once('register-utilities.php'); 
$registerUtil = new RegisterUtilities();

require_once('change-login-utilities.php'); 
$changeUtil = new ChangeLoginUtilities();

$change_done = false;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$form_errors = array();	
	// validate and sanitize the member inputs
	$success = $changeUtil->checkQandA($_POST['answer_1'], $_POST['answer_2'], $_SESSION['member_id'], 
							$mdb_control, $registerUtil, $form_errors);	
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
		$success = $changeUtil->saveNewPassword($db_connect, $_SESSION['member_id'], $password, $mdb_control);	
		
		if($success) 
		{
			echo
			'<div class="form-errors">
				<br>
				<h2>Thank you, your new password has been saved.</h2>
				</br>
			</div>';
			
			$change_done = true;
			
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



?>