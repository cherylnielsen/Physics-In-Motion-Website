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
	$found = false;
	$ok = true;
	
	// validate the member inputs
	$account_type = $register->validate_account_type($_POST['account_type'], $form_errors);
	$register->validate_name($_POST['first_name'], "First", $form_errors);
	$register->validate_name($_POST['last_name'], "Last", $form_errors);
	$register->validate_name($_POST['school'], "School", $form_errors);	
	$register->validate_password($_POST['password'], $_POST['password_confirm'], $form_errors);
	
	$ok = $register->validate_membername($_POST['membername'], $_POST['membername_confirm'], $form_errors);
	if($ok) 
	{
		$found = $register->duplicate_member_name($membername, $mdb_control, $form_errors);
	}

	$ok = $register->validate_emails($_POST['email'], $_POST['email_confirm'], $form_errors);
	if($ok)
	{
		$found = $register->duplicate_email($email, $account_type, $mdb_control, $form_errors);
	}
	
	if(count($form_errors) != 0)
	{
		$register->display_errors($form_errors);
	}
	else
	{
		// Save the data to the database
		$ok = $register->register_new_member($firstname, $lastname, $email, $school, 
				$account_type, $membername, $password, $mdb_control);
				
		if($ok) 
		{
			// Redirect the new member to the login page
			$url = "login-page.php";
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