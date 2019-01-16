<?php

require_once('register-utilities.php'); 
	
If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$register_utility = new RegisterUtilities();
	$form_errors = array();
	$account_type = null;
		
	// validate and sanitize first name and last name
	$firstname = $register_utility->validate_name($_POST['first_name'], "First", $form_errors);
	$lastname = $register_utility->validate_name($_POST['last_name'], "Last", $form_errors);
	
	// validate and sanitize email
	$email = $register_utility->validate_emails($_POST['email'], $_POST['email_confirm'], $form_errors);
	
	// validate and sanitize school name
	$school = $register_utility->validate_name($_POST['school'], "School", $form_errors);
	
	// The account_type is a radio button set, so no sanitizing or validation is needed.
	if(!isset($_POST['account_type'])) 
	{ 	
		$form_errors[] = 'Enter student or professor.';
	}
	else
	{
		$account_type = $_POST['account_type'];
	}
		
	// validate and sanitize password and user name
	$username = $register_utility->validate_pw_username("username", $_POST['username'], 
						$_POST['username_confirm'], $form_errors);
	$password = $register_utility->validate_pw_username("password", $_POST['password'], 
						$_POST['password_confirm'], $form_errors);
	
	// test for duplicate email or user name in the database
	
	if((count($form_errors) == 0) AND (isset($_POST['account_type'])))
	{
		$account_type = $_POST['account_type'];
		$found_email = $register_utility->duplicate_test("email", $email, $account_type, $mdb_control);
		$found_username = $register_utility->duplicate_test("user_name", $username, $account_type, $mdb_control);
		
		if($found_username)
		{
			$form_errors[] = 'User name is already in use. Please try again';
		}
		
		if($found_email)
		{
			$form_errors[] = 'Email is already in use. Please try again';
		}
		
		if($duplicate && $found)
		{
			$form_errors[] = 'User may already exist, try again or <a id="sign-in" href="login-page.php">Sign In</a> or <a id="forgot_login" href="">Forgot ID / Password?</a>';
		}
	}
	
	
	if(count($form_errors) != 0)
	{
		// display errors
		echo'<div class="form-errors"><p>Errors:</p>';
				
		foreach($form_errors as $str)
		{
			echo "<p> $str </p>";
		}
		
		echo '</div>';
	}
	else
	{
		// Save the data to the database and redirect to the login page
		$ok = $register_utility->register_new_user($firstname, $lastname, $email, $school, 
				$account_type, $username, $password, $mdb_control);
				
		if($ok) 
		{
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