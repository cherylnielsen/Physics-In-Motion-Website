<?php

class RegisterUtilities
{
	public function __construct() {}
	
	public function sanitize_input($data_input)
	{
		if(!isset($data_input)) { return null; }
		
		// The following lines are safety measures recommended by w3schools.com
		$data_input = strip_tags($data_input);	
		$data_input = stripslashes($data_input);
		$data_input = trim($data_input);
		if(strlen($data_input) == 0) { return null; }
		
		return $data_input;
	}
	
	
	public function validate_emails($email, $email_confirm, &$form_errors)
	{	
		$email = $this->sanitize_input($email);
		$email_confirm = $this->sanitize_input($email_confirm);
		
		// tests for zero length and other errors
		if(!isset($email) || !isset($email_confirm))
		{ 	
			$form_errors[] = 'Enter an email.';
		}
		else if((strlen($email) == 0) || (strlen($email) == 0))
		{
			$form_errors[] = 'Enter an email.';
		}
		// check that the emails are the same
		else if(strcmp($email, $email_confirm) != 0)
		{
			$form_errors[] = 'The emails do not match.';
		}
		// checks that email string is properly formated
		else if ((filter_var($email, FILTER_VALIDATE_EMAIL) === false))
		{
			$form_errors[] = 'The email format is not valid.';
		}

		return $email;
	}
	
	
	public function validate_name($name, $type, &$form_errors)
	{
		// tests for zero length and other errors
		$name = $this->sanitize_input($name);
		
		if(is_null($name)) 
		{ 	
			$form_errors[] = "Enter $type";
		}
		else
		{
			if (!preg_match("/^[a-zA-Z0-9 \-\'\.]+$/", $name))
			{
				$form_errors[] = "$type names can only contain letters, numbers, or - .' and spaces.";
			}
		}
		
		return $name;
	}
	
	
	public function validate_pw_username($data_type, $data, $data_confirm, &$form_errors)
	{
		if((is_null($data)) || (is_null($data_confirm)))
		{ 	
			$form_errors[] = "Enter $data_type";
		}
		else if(0 != strcmp($data, $data_confirm))
		{
				$form_errors[] = 'The ' . $data_type . 's do not match.';
		}
		else
		{
			// Both are the same, so compare password to reg expressions.
			//(min 1 letter & 1 number & 8 char long)
			if(strlen($data) < 8)
			{
				$form_errors[] = "The $data_type must contain at least 8 characters.";
			}		
			if(!preg_match("/[A-Z]+/",$data))
			{
				$form_errors[] = "The $data_type must contains at least one uppercase letter.";
			}
			if(!preg_match("/[a-z]+/",$data))
			{
				$form_errors[] = "The $data_type must contains at least one lowercase letter.";
			}
			if(!preg_match("/[0-9]+/",$data))
			{
				$form_errors[] = "The $data_type must contains at least one number.";
			}
			if (preg_match("/\\s/", $data))
			{
				$form_errors[] = "The $data_type cannot have spaces.";
			}
		}
		
		return $data;
	}
	
	
	public function duplicate_test($attribute, $data, $account_type, $mdb_control)
	{
		$ok = false;		
		$control = $mdb_control->getController($account_type);
		$db_con = $control->get_db_connection();
		
		// escape user input variables for quote marks, etc.
		$data_escaped = mysqli_real_escape_string($db_con, $data);		
		// find in the database
		$duplicate = $control->getByAttribute($attribute, $data_escaped);
		
		if((!is_null($duplicate)) AND (count($duplicate) > 0))
		{
			$ok = true;
		}
		
		return $ok;
	}
	
	
	public function register_new_user($firstname, $lastname, $email, $school, 
						$account_type, $username, $password, $mdb_control)
	{
		// escape user input variables for quote marks, etc.
		// account_type dose not need escaping
		$control = $mdb_control->getController($account_type);
		$db_con = $control->get_db_connection();
		
		$username = mysqli_real_escape_string($db_con, $username);
		$password = mysqli_real_escape_string($db_con, $password);
		$firstname = mysqli_real_escape_string($db_con, $firstname);
		$lastname = mysqli_real_escape_string($db_con, $lastname);
		$email = mysqli_real_escape_string($db_con, $email);
		$school = mysqli_real_escape_string($db_con, $school);
		
		// save login as user
		$user = new Users();
		$user->initialize(null, $username, $password, $account_type);
		$ok = $mdb_control->save_new($user, "users");
		$person = null;
		
		// save user as student or professor
		if($ok) 
		{
			$user_id = $user->get_user_id();
			
			switch ($account_type)
			{
				case "student":
					$person = new Student();
					$person->initialize($user_id, $firstname, $lastname, $school, $email);
					$ok = $mdb_control->save_new($person, "student");
					break;
					
				case "professor":
					$person = new Professor();
					$person->initialize($user_id, $firstname, $lastname, $school, $email);
					$ok = $mdb_control->save_new($person, "professor");
					break;
			}
		}
		
		return $ok;
	}
	
	
}

?>