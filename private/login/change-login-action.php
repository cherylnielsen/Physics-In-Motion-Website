<?php

require_once('login-utilities.php');
require_once('register-utilities.php'); 

If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$register = new RegisterUtilities();
	$loginUtil = new LoginUtilities();
	$form_errors = array();
	
	$member = new Member();
	$member_control = $mdb_control->getController("member");
	$member = $member_control->getByPrimaryKey("member_id", $_SESSION['member_id']);

	// validate and sanitize the member inputs
	$password_OK = $register->validate_password($_POST['password'], $_POST['password_confirm'], $form_errors);
	
	if(!$password_OK)
	{
		$register->display_errors($form_errors);
	}
	else
	{
		// Save the new password to the database
		$db_connect= get_db_connection();
		$password = mysqli_real_escape_string($db_connect, $_POST['password']);
		$password = password_hash($password, PASSWORD_DEFAULT);
		$member->set_member_password($password);
		$success = $member_control->updateAttribute($member, "member_password");	
		
		if($success) 
		{
			echo
			'<div class="form-errors">
				<br>
				<h2>Thank you, your new password has been saved.</h2>
				</br>
			</div>';
		}
		else
		{
			echo'<div class="form-errors">
					<p>Sorry, the password change could not be saved. 
						Please try again later.</p>
				</div>';
		}
		
	}
	
}


?>