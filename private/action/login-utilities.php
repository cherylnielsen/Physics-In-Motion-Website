<?php

class LoginUtilities
{
	
	public function __construct() {}
	
	public function sanitize_input($data_input, $db_connection)
	{
		if(isset($data_input))
		{		
			$data_input = trim($data_input);
			$data_input = filter_var($data_input, FILTER_SANITIZE_STRING);		
			$data_input = mysqli_real_escape_string($db_connection, $data_input);
		}
		else
		{
			$data_input = null;	
		}
		
		if(strlen($data_input) == 0)
		{				
			$data_input = null;				
		}
		
		return $data_input;
	}

	public function sanitize_email($email)
	{
		if(isset($email))
		{		
			$email = trim($email);	
			
			if(strlen($email) > 0)
			{
				$email = filter_var($email, FILTER_SANITIZE_EMAIL);				
				return $email;				
			}

			return null;
		}
		
		return null;
	}
	
	
	public function check_email_format($email)
	{
		$email_error = null;
		
		if(!isset($email))
		{ 	
			$email_error = 'Enter an email.';
		}
		else if(strlen($email) == 0)
		{
			$email_error = 'Enter an email.';
		}
		else 
		{
			// checks that email string is properly formated
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
			{
				$email_error = 'The email format is not valid.';
			}			
		}
		
		return $email_error;
	}
	
	
	public function validate_emails($email, $email_confirm, &$form_errors)
	{	
		$email_error = null;
		$email = $this->sanitize_email($_POST['email']);
		$email_confirm = $this->sanitize_email($_POST['email_confirm']);
		
		if(strcmp($email, $email_confirm) != 0)
		{
			$form_errors[] = 'The emails do not match.';
		}
		else
		{
			$err1 = $this->check_email_format($email);
			$err2 = $this->check_email_format($email_confirm);
			
			if(!is_null($err1))
			{ 
				$form_errors[] = $err1; 
			}			
			else if(!is_null($err2))
			{ 
				$form_errors[] = $err2; 
			}
		}
		
		return $email;
	}
	
	
	public function validate_name($name, $type, &$form_errors, $db_connection)
	{
		$name = $this->sanitize_input($name, $db_connection);
		$name_error = null;
		
		if(is_null($name)) 
		{ 	
			$form_errors[] = "Enter $type name.";
		}
		else
		{
			if (!preg_match("/^[a-zA-Z ]*$/",$name))
			{
				$form_errors[] = "$type names can only contain letters and spaces.";
			}
		}
		
		return $name;
	}
	
	
	public function validate_passwords($type, $password, $password_confirm, &$form_errors, $db_connection)
	{
		$pw_error = array();
		$password = $this->sanitize_input($password, $db_connection);
		$password_confirm = $this->sanitize_input($password_confirm, $db_connection);
		
		if((is_null($password)) || (is_null($password_confirm)))
		{ 	
			$form_errors[] = "Enter $type.";
		}
		else
		{
			if(0 != strcmp($password, $password_confirm))
			{
				$form_errors[] = 'The ' . $type . 's do not match.';
			}
			else
			{
				// Both are the same, so compare password to reg expressions.
				//(min 1 letter & 1 number & 8 char long)
				if(strlen($password) < 8)
				{
					$form_errors[] = "The $type must contain at least 8 characters.";
				}		
				if(!preg_match("/[a-zA-Z]+/",$password))
				{
					$form_errors[] = "The $type must contains at least one letter.";
				}
				if(!preg_match("/[0-9]+/",$password))
				{
					$form_errors[] = "The $type must contains at least one number.";
				}
			}
		}
		
		if(count($pw_error) == 0)
		{
			$pw_error = null;
		}
		
		return $password;
	}
	
	
	public function authenticate_login(&$user, $username, $password, $mdb_control)
	{		
		$ok = true;
		
		if(!is_null($username) && (!is_null($password)))
		{
			$user = $mdb_control->get_users_by_login($username, $password);
		}
		else
		{
			$user = null;
			$ok = false;
		}

		if(isset($user)) 
		{
			if(strlen($user->get_user_id()) > 0)
			{
				$ok = true;
			}	
			else
			{
				$user = null;
				$ok = false;
			}
		}
		else
		{
			$user = null;
			$ok = false;
		}
		
		return $ok;
		
	}
	
	
	public function get_user_info($user_id, $user_type, $mdb_control)
	{
		$user = array();
		$attribute = $user_type . '_id';		
		$user = $mdb_control->get_by_attribute($user_id, $attribute, $user_type);		
		return $user;		
	}
	
	
	public function duplicate_email_test($email, $account_type, $db_connection, $mdb_control)
	{
		$duplicate = false;
		$data = $mdb_control->get_by_attribute($email, "email", $account_type);
		
		if((!is_null($data)) AND (count($data) > 0))
		{
			$duplicate = true;
		}
		
		return $duplicate;
	}
	
	
	public function duplicate_username_test($user_name, $db_connection, $mdb_control)
	{
		$duplicate = false;
		$data = $mdb_control->get_by_attribute($user_name, "user_name", "users");
		
		if((!is_null($data)) AND (count($data) > 0))
		{
			$duplicate = true;
		}
		
		return $duplicate;
	}
	
	
	public function register_new_user($firstname, $lastname, $email, $school, 
				$account_type, $username, $password, $db_connection, $mdb_control)
	{
		$user = new Users();
		$user->initialize(null, $username, $password, $account_type);
		$ok = $mdb_control->save_new($user, "users");
		$person = null;
		
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
			
			if(!$ok)
			{
				// add code to remove new User from db
			}
		}
		
		return $ok;
	}
	

}

?>