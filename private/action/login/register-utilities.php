<?php

class RegisterUtilities
{
	
	public function __construct() {}
	
	
	public function display_errors($form_errors)
	{
		echo'<div class="form-errors"><p>Errors:</p>';		
		
		foreach($form_errors as $str) 
		{ 
			echo "<p> $str </p>"; 
		}	
		
		echo '</div>';
	}
	
	
	public function sanitize_input($data_input, $data_type, &$form_errors)
	{
		$ok = true;
		
		if(!isset($data_input)) 
		{ 
			$form_errors[] = 'Enter $data_type.';
			return false; 
		}
		else if(strlen($data_input) == 0)
		{ 
			$form_errors[] = 'Enter $data_type.';
			return false; 
		}
		
		// removes < and > and <all enclosed items>
		$data = strip_tags($data_input);	
		
		if(strcmp($data, $data_input) != 0)
		{
			$form_errors[] = "The symbols < and > are not allowed in $data_type.";
			$ok = false;
		}
		
		$data_input = stripslashes($data_input);
		
		if(strcmp($data, $data_input) != 0)
		{
			$form_errors[] = "The back slash symbol \\ is not allowed in $data_type.";
			$ok = false;
		}
		
		$data_input = trim($data_input);
		
		if(strlen($data_input) == 0) 
		{ 
			$ok = false; 
		}
		
		return $ok;
	}
	
	
	public function validate_account_type($account_type, &$form_errors)
	{
		if(!isset($account_type)) 
		{ 
			$form_errors[] = 'Enter student or professor.'; 
			$account_type = null;
		}
		
		return $account_type;
	}
	
	
	public function validate_emails($email, $email_confirm, &$form_errors)
	{			
		$ok = true;
		
		// tests for zero length and other errors
		if(!($this->sanitize_input($email, "Email", $form_errors)))
		{ 
			$ok = false; 
		}
	
		if(!($this->sanitize_input($email_confirm, "Email", $form_errors)))
		{ 
			$ok = false; 
		}
		
		// check that the emails are the same
		if(strcmp($email, $email_confirm) != 0)
		{
			$form_errors[] = 'The emails do not match.';
			$ok = false;
		}
		// checks that email string is properly formated
		else if ((filter_var($email, FILTER_VALIDATE_EMAIL) === false))
		{
			$form_errors[] = 'The email format is not valid.';
			$ok = false;
		}
		
		return $ok;
	}
	
	
	public function validate_name($name, $data_type, &$form_errors)
	{
		$ok = true;
		
		// tests for zero length and other errors
		if(!($this->sanitize_input($name, $data_type, $form_errors))) 
		{ 	
			$form_errors[] = "Enter $data_type";
			$ok = false;
		}
		else
		{
			// pattern match for required characters
			if (!preg_match("/^[a-zA-Z0-9 \-\'\.]+$/", $name))
			{
				$form_errors[] = "$data_type names can only contain letters, numbers, or - .' and spaces.";
				$ok = false;
			}
		}
		
		return $ok;
	}
	
	
	public function validate_pw_un_pattern($data_type, $data, &$form_errors)
	{
		$ok = true;
		
		// compare password or user name to the required reg expression patterns.
		//(min 1 letter & 1 number & 8 char long)
		if(strlen($data) < 8)
		{
			$form_errors[] = "The $data_type must contain at least 8 characters.";
			$ok = false;
		}		
		if(!preg_match("/[A-Z]+/",$data))
		{
			$form_errors[] = "The $data_type must contains at least one uppercase letter.";
			$ok = false;
		}
		if(!preg_match("/[a-z]+/",$data))
		{
			$form_errors[] = "The $data_type must contains at least one lowercase letter.";
			$ok = false;
		}
		if(!preg_match("/[0-9]+/",$data))
		{
			$form_errors[] = "The $data_type must contains at least one number.";
			$ok = false;
		}
		if (preg_match("/\\s/", $data))
		{
			$form_errors[] = "The $data_type cannot have spaces.";
			$ok = false;
		}

		return $ok;
	}
	
	
	public function validate_username($username, $username_confirm, &$form_errors)
	{
		$ok = true;
		
		// tests for zero length and other errors
		if(!($this->sanitize_input($username, "User Name", $form_errors)))
		{ 
			$ok = false; 
		}
		
		if(!($this->sanitize_input($username_confirm, "User Name", $form_errors)))
		{ 
			$ok = false; 
		}
			
		if(0 != strcmp($username, $username_confirm))
		{
			$form_errors[] = 'The User Names do not match.';
			$ok = false;
		}
		else
		{
			$ok = $this->validate_pw_un_pattern("User Name", $username, $form_errors);
		}

		return $ok;
	}
	
	
	public function validate_password($password, $password_confirm, &$form_errors)
	{
		$ok = true;
		
		// tests for zero length and other errors
		if(!($this->sanitize_input($password, "Password", $form_errors))) 
		{ 
			$ok = false; 
		}
		
		if(!($this->sanitize_input($password_confirm, "Password", $form_errors))) 
		{ 
			$ok = false; 
		}
		
		if(0 != strcmp($password, $password_confirm))
		{
			$form_errors[] = 'The Passwords do not match.';
			$ok = false;
		}
		else
		{
			$ok = $this->validate_pw_un_pattern("Password", $password, $form_errors);
		}

		return $ok;
	}
	
	
	public function duplicate_user_name($username, $mdb_control, &$form_errors)
	{
		$ok = true;		
		$control = $mdb_control->getController("users");
		$db_con = $control->get_db_connection();
		
		// escape user input variables for quote marks, etc.
		$username = mysqli_real_escape_string($db_con, $username);		
		// find in the database
		$duplicate = $control->getByAttribute("user_name", $username);
		
		if(count($duplicate) > 0)
		{
			$form_errors[] = 'User name is already in use. ';
			$ok = false;
		}
		
		return $ok;
	}
	
	
	public function duplicate_email($email, $account_type, $mdb_control, &$form_errors)
	{
		$ok = true;		
		$control = $mdb_control->getController($account_type);
		$db_con = $control->get_db_connection();
		
		// escape user input variables for quote marks, etc.
		$data_escaped = mysqli_real_escape_string($db_con, $email);		
		// find in the database
		$duplicate = $control->getByAttribute("email", $data_escaped);
		
		if(count($duplicate) > 0)
		{
			$form_errors[] = 'Email is already in use. ';
			$form_errors[] = 'Try again, or <a id="sign-in" href="login-page.php">Sign In,</a> or <a id="forgot_login" href="">Forgot ID / Password?</a>';
			$ok = false;
		}

		return $ok;
	}
	
	public function register_new_user($firstname, $lastname, $email, $school, 
						$account_type, $username, $password, $mdb_control)
	{
		$ok = true;
		// MySQL DATETIME format
		$format = date("Y-m-d H:i:s");
		$date_registered = date($format, time());
		$control = $mdb_control->getController("users");
		$db_con = $control->get_db_connection();
		
		$username = mysqli_real_escape_string($db_con, $username);
		$password = mysqli_real_escape_string($db_con, $password);
		
		// save new user
		$user = new Users();
		$password = password_hash($password, PASSWORD_DEFAULT);
		$user->initialize(null, $account_type, $username, $password, $date_registered, null, null);
		$ok = $control->saveNew($user);
		$person = null;
		
		// save user as student or professor
		if($ok) 
		{
			$control = $mdb_control->getController($account_type);
			$user_id = $user->get_user_id();
			// escape user input variables for quote marks, etc.
			// account_type dose not need escaping
			$firstname = mysqli_real_escape_string($db_con, $firstname);
			$lastname = mysqli_real_escape_string($db_con, $lastname);
			$email = mysqli_real_escape_string($db_con, $email);
			$school = mysqli_real_escape_string($db_con, $school);
			
			switch ($account_type)
			{
				case "student":
					$person = new Student();
					$person->initialize($user_id, $firstname, $lastname, $school, $email);
					$ok = $control->saveNew($person);
					break;
					
				case "professor":
					$person = new Professor();
					$person->initialize($user_id, $firstname, $lastname, $school, $email);
					$ok = $control->saveNew($person);
					break;
					
				case "administrator":
					$person = new Administrator();
					$person->initialize($user_id, $firstname, $lastname, $school, $email);
					$ok = $control->saveNew($person);
					break;
			}
		}
		
		return $ok;
	}	
	
}

?>