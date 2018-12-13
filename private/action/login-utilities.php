<?php

class LoginUtilities
{
	
	public function __construct() {}
	
	
	public function validate_username($username, $db_connection)
	{
		if(isset($username))
		{	
			$username = trim($username);
	
			if(!empty($username))
			{
				$username = mysqli_real_escape_string($db_connection, $username);
				$username = strip_tags($username);
			}
			else 
			{
				$username = null;
			}
		}
		else
		{
			$username = null;
		}
		
		return $username;
	}
	

	public function validate_password($password, $db_connection)
	{
		if(isset($password))
		{		
			$password = trim($password);
			
			if(!empty($password))
			{
				$password = mysqli_real_escape_string($db_connection, $password);
				$password = strip_tags($password);
			}
			else 
			{
				$password = null;
			}
		}
		else
		{
			$password = null;
		}
		
		return $password;
	}


	public function authenticate_login($username, $password, $mdb_control)
	{
		if( is_null($username) || is_null($password) || empty($username) || empty($password) )
		{
			echo'<div class="form-errors">
			<p><em>Error: Please enter user name and password.</em>
			</p></div>';
			
			return null;
		}
		else
		{
			$user = $mdb_control->get_users_by_login($username, $password);
			
			if(!is_null($user) && !empty($user->get_user_id()))
			{
				return $user;
			}
		}
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