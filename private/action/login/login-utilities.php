<?php

class LoginUtilities
{		
	public function __construct() {}
	
	public function authenticate_login($membername, $password, $mdb_control)
	{		
		// find in the database
		$member = null;
		$member_control = $mdb_control->getController("member");
		$member = $member_control->get_by_login($membername, $password);
		return $member;
	}	
	
	
	public function get_user($member_id, $member_type, $mdb_control)
	{		
		// find in the database
		$user_array = array();
		$user = null;
		$control = $mdb_control->getController($member_type);
		$user_array = $control->getByAttribute("member_id", $member_id);
		
		if(!is_null($user_array) && count($user_array) > 0) 
		{
			$user = $user_array[0];
		}
		
		return $user;
	}
	
	
	public function update_last_login($member, $mdb_control)
	{
		$success = false;
		// MySQL DATETIME format
		$format = date("Y-m-d H:i:s");
		$login_time = date($format, time());
		$member_control = $mdb_control->getController("member");
		$success = $member_control->updateAttribute($member, "last_login", $login_time);
		
		return $success;
	}

	
	public function update_last_logout($member_id, $mdb_control)
	{
		$success = false;
		// MySQL DATETIME format
		$format = date("Y-m-d H:i:s");
		$logout_time = date($format, time());	
		$member_control = $mdb_control->getController("member");
		$member = array();
		$member = $member_control->getByAttribute("member_id", $member_id);
		
		if(count($member) > 0)
		{
			$member = $member[0];
			$success = $member_control->updateAttribute($member, "last_logoff", $logout_time);
		}
		
		return $success;
	}
	
	
}
	
?>