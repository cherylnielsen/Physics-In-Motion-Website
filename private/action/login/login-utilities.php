<?php

class LoginUtilities
{		
	public function __construct() {}
	
	public function authenticate_login($username, $password, $mdb_control)
	{		
		// find in the database
		$user = null;
		$user_control = $mdb_control->getController("users");
		$user = $user_control->get_by_login($username, $password);
		return $user;
	}	
	
	
	public function get_member($user_id, $member_type, $mdb_control)
	{		
		// find in the database
		$member_array = array();
		$member = null;
		$control = $mdb_control->getController($member_type);
		$member_array = $control->getByAttribute("user_id", $user_id);
		
		if(!is_null($member_array) && count($member_array) > 0) 
		{
			$member = $member_array[0];
		}
		
		return $member;
	}
	
	
	public function update_last_login($user, $mdb_control)
	{
		$success = false;
		// MySQL DATETIME format
		$format = date("Y-m-d H:i:s");
		$login_time = date($format, time());
		$user_control = $mdb_control->getController("users");
		$success = $user_control->update_attribute($user, "last_login", $login_time);
		
		return $success;
	}

	
	public function update_last_logout($user_id, $mdb_control)
	{
		$success = false;
		// MySQL DATETIME format
		$format = date("Y-m-d H:i:s");
		$logout_time = date($format, time());	
		$user_control = $mdb_control->getController("users");
		$users = array();
		$users = $user_control->getByAttribute("user_id", $user_id);
		
		if(count($users) > 0)
		{
			$user = $users[0];
			$success = $user_control->update_attribute($user, "last_logoff", $logout_time);
		}
		
		return $success;
	}
	
	
}
	
?>