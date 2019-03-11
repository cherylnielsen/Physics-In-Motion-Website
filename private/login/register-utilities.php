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
	
	
	public function validate_member_type($member_type, &$form_errors)
	{
		if(!isset($member_type)) 
		{ 
			$form_errors[] = 'Enter student or professor.'; 
		}
		
		return $member_type;
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
		
		// compare password or member name to the required reg expression patterns.
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
	
	
	public function validate_membername($membername, $membername_confirm, &$form_errors)
	{
		$ok = true;
		
		// tests for zero length and other errors
		if(!($this->sanitize_input($membername, "Member Name", $form_errors)))
		{ 
			$ok = false; 
		}
		
		if(!($this->sanitize_input($membername_confirm, "Member Name", $form_errors)))
		{ 
			$ok = false; 
		}
			
		if(0 != strcmp($membername, $membername_confirm))
		{
			$form_errors[] = 'The Member Names do not match.';
			$ok = false;
		}
		else
		{
			$ok = $this->validate_pw_un_pattern("Member Name", $membername, $form_errors);
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
	
	
	public function uniqueness_test($email, $membername, $mdb_control, &$form_errors)
	{
		$ok = true;	
		$found_email = false;
		$found_username = false;
		$control = $mdb_control->getController("member");
		$db_connect = get_db_connection();
		
		// escape member input variables for quote marks, etc.
		$membername = mysqli_real_escape_string($db_connect, $membername);	
		$email = mysqli_real_escape_string($db_connect, $email);		
		
		// find in the database
		$duplicate = $control->getByAttribute("member_name", $membername);
		
		if(count($duplicate) > 0)
		{
			$form_errors[] = 'Member Name is already in use. ';
			$found_username = true;
			$ok = false;	
		}
		
		$duplicate = $control->getByAttribute("email", $email);
		
		if(count($duplicate) > 0)
		{
			$form_errors[] = 'Email is already in use. ';
			$found_email = true;
			$ok = false;	
		}
		
		if($found_username && $found_email)
		{
			$form_errors[] = 'Try again, or <a id="sign-in" 
			href="login-register-page.php?form_type=login">
			Sign In,</a> or <a id="forgot_login" href="">Forgot Member Name / Password?</a>';
			$ok = false;
		}
		
		return $ok;
	}
	
	
	public function register_new_member($firstname, $lastname, $email, $school, 
						$member_type, $membername, $password, $mdb_control)
	{
		$ok = true;
		// MySQL DATETIME format
		$format = date("Y-m-d H:i:s");
		$date_registered = date($format, time());
		$control = $mdb_control->getController("member");
		$db_connect = get_db_connection();
		
		$membername = mysqli_real_escape_string($db_connect, $membername);
		$password = mysqli_real_escape_string($db_connect, $password);
		$firstname = mysqli_real_escape_string($db_connect, $firstname);
		$lastname = mysqli_real_escape_string($db_connect, $lastname);
		$email = mysqli_real_escape_string($db_connect, $email);
		$school = mysqli_real_escape_string($db_connect, $school);
		$complete = true;
		
		// save new member
		$member = new Member();
		$password = password_hash($password, PASSWORD_DEFAULT);
		$member->initialize(null, $member_type, $membername, $password, $date_registered, null, null, $firstname, $lastname, $email, $complete);
		$ok = $control->saveNew($member);
		$person = null;
		
		// save member as student or professor
		if($ok) 
		{
			$control = $mdb_control->getController($member_type);
			$member_id = $member->get_member_id();
			// escape member input variables for quote marks, etc.
			// member_type dose not need escaping
			
			switch ($member_type)
			{
				case "student":
					$person = new Student();
					$person->set_school_name($school);
					$person->set_student_id($member_id);
					$ok = $control->saveNew($person);
					break;
					
				case "professor":
					$person = new Professor();
					$person->set_school_name($school);
					$person->set_professor_id($member_id);
					$ok = $control->saveNew($person);
					break;
					
				case "administrator":
					$person = new Administrator();
					$admin_type = "General";
					$person->set_admin_type($admin_type);
					$person->set_administrator_id($member_id);
					$ok = $control->saveNew($person);
					break;
			}
		}
		
		return $ok;
	}	
	
}

?>