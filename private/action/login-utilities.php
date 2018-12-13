<?php

class LoginUtilities
{
	
	public function __construct() {}
	
	public function validate_input($data_input, $db_connection)
	{
		if(isset($data_input))
		{		
			$data_input = trim($data_input);
			$data_input = filter_var($data_input, FILTER_SANITIZE_STRING);		
			$data_input = mysqli_real_escape_string($db_connection, $data_input);
		}
		else
		{
			return null;	
		}
		
		if(strlen($data_input) <= 0)
		{				
			return null;				
		}
		
		return $data_input;
	}

	public function validate_email($email)
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
	
	
	public function validate_email_format($email)
	{
		$error = null;
		
		if(!isset($email))
		{ 	
			$error = 'Enter an email.';
		}
		else if(strlen($email) <= 0)
		{
			$error = 'Enter an email.';
		}
		else 
		{
			// checks that email string is properly formated
			if (filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$error = 'The email format is not valid.';
			}			
		}
		
		return $error;
	}
	
	
	public function authenticate_login($username, $password, $mdb_control)
	{
		$user;
		
		if( is_null($username) || is_null($password) || empty($username) || empty($password) )
		{
			return null;
		}
		else
		{
			$user = $mdb_control->get_users_by_login($username, $password);

			if(isset($user)) 
			{
				if(!empty($user->get_user_id()))
				{
					return $user;
				}	
			}
		}
		
		return null;
	}
	
	
	public function get_user_info($user_id, $user_type, $mdb_control)
	{
		$user = array();
		$attribute = $user_type . '_id';		
		$user = $mdb_control->get_by_attribute($user_id, $attribute, $user_type);		
		return $user;		
	}
	
	
	

}

?>