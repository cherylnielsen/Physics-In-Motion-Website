<?php

class LoginUtilities
{
	
	public function __construct() {}
	
	public function validate_input($data_input, $db_connection)
	{
		if(isset($data_input))
		{		
			if(!empty($data_input))
			{
				$data_input = trim($data_input);
				$data_input = mysqli_real_escape_string($db_connection, $data_input);
				$data_input = strip_tags($data_input);	
				return $data_input;				
			}
		}
		
		return null;
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
		}
			
		if(isset($user)) 
		{
			if(!empty($user->get_user_id()))
			{
				return $user;
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