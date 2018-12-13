<?php

require_once('login-utilities.php'); 
	
If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$login_utility = new LoginUtilities();
	$form_errors = array();
	
	// account_type is a radio button set so no input validation needed
	if(!isset($_POST['account_type'])) 
	{ 	
		$form_errors[] = 'Enter student or professor.';
	}
	else
	{
		$account_type = $_POST['account_type'];
	}

	// validate and preprocess emails	
	$email = $login_utility->validate_email($_POST['email']);
	$email_confirm = $login_utility->validate_email($_POST['email_confirm']);
	
	$str_error = $login_utility->validate_email_format($email);
	if(!is_null($str_error))
	{
		$error_array[] = $str_error;
	}
	
	$str_error = $login_utility->validate_email_format($email_confirm);
	if(!is_null($str_error))
	{
		$error_array[] = $str_error;
	}
	
	if(0 != strcmp($email, $email_confirm))
	{
		$error_array[] = 'The emails do not match.';
		$email_ok = false;
	}
	
	
	$first_name = $login_utility->validate_input($_POST['first_name'], $db_connection);
	$last_name = $login_utility->validate_input($_POST['last_name'], $db_connection);
	$school = $login_utility->validate_input($_POST['school'], $db_connection);
	$username = $login_utility->validate_input($_POST['username'], $db_connection);
	
	if(!isset($first_name) || !isset($last_name))
	{ 	
		$form_errors[] = 'Enter first and last name.';
	}
	
	if(!isset($school)) 
	{ 	
		$form_errors[] = 'Enter school name.';
	}
	
	if(!isset($username)) 
	{ 	
		$form_errors[] = 'Enter user name.';
	}
	
	if (!(preg_match("/^[a-zA-Z ]*$/",$first_name)) || (!preg_match("/^[a-zA-Z ]*$/",$last_name)))
	{
		$form_errors[] = 'First and last name can only contain letters and spaces.';
	}
	
	if (!preg_match("/^[a-zA-Z ]*$/",$school))
	{
		$form_errors[] = 'School names can only contain letters and spaces.';
	}
	
	$password = $login_utility->validate_input($_POST['password'], $db_connection);
	$password_confirm = $login_utility->validate_input($_POST['password_confirm'], $db_connection);
	
	if((!isset($password)) || (!isset($password_confirm)))
	{ 	
		$form_errors[] = 'Enter password.';
	}
	else
	{
		if(0 != strcmp($password, $password_confirm))
		{
			$form_errors[] = 'The passwords do not match.';
		}
		else
		{
			// compare password to reg expression
			//(min 1 letter & 1 number & 8 char long)
			if(strlen($password) < 8)
			{
				$form_errors[] = 'The password contains less than 8 characters.';
			}		
			if(!preg_match("/[a-zA-Z]+/",$password))
			{
				$form_errors[] = 'The password must contains at least one letter.';
			}
			if(!preg_match("/[0-9]+/",$password))
			{
				$form_errors[] = 'The password must contains at least one number.';
			}
		}
	}
	
	
	if(count($form_errors) == 0)
	{
		// save data to the database and redirect to the login page
		echo'<div class="form-errors"><p><em>Yes, no errors!</em></p></div>';
	}
	else
	{
		//display errors
		echo'<div class="form-errors"><p><em>Errors:</em></p>';
				
		foreach($form_errors as $str)
		{
			echo "$str <br>";
		}
		
		echo '</div>';
	}
	

}




?>