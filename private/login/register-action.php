<?php

require_once('register-utilities.php'); 
	
If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$register = new RegisterUtilities();
	$form_errors = array();
	$firstname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$email = $_POST['email'];
	$school = $_POST['school'];
	$membername = $_POST['membername'];
	$password = $_POST['password'];
	$member_type = $_POST['member_type'];
	
	// validate the member inputs
	$member_type = $register->validate_member_type($member_type, $form_errors);
	$register->validate_name($firstname, "First", $form_errors);
	$register->validate_name($lastname, "Last", $form_errors);
	$register->validate_name($school, "School", $form_errors);	
	$register->validate_password($_POST['password'], $_POST['password_confirm'], $form_errors);
	
	$ok_name = $register->validate_membername($_POST['membername'], $_POST['membername_confirm'], $form_errors);
	$ok_email = $register->validate_emails($_POST['email'], $_POST['email_confirm'], $form_errors);
	
	if($ok_name && $ok_email)
	{
		$register->uniqueness_test($email, $membername, $mdb_control, $form_errors);
	}
	
	if(count($form_errors) != 0)
	{
		$register->display_errors($form_errors);
	}
	else
	{
		// Save the data to the database
		$ok = $register->register_new_member($firstname, $lastname, $email, $school, 
				$member_type, $membername, $password, $mdb_control);		
		
		if($ok) 
		{
			// Redirect the new member to the login page
			$url = "login-register-page.php?form_type=login";
			header("Location: $url");
			exit();
		}
		else
		{
			echo'<div class="form-errors"><p>Sorry, we goofed!:</p>
				<p>Registration could not be saved. Please try again later.</p></div>';
		}
		
	}
	
}


?>