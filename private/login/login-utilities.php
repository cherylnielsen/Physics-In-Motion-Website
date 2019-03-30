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
		$user = null;
		$control = $mdb_control->getController($member_type);
		
		switch($member_type)
		{
			case 'student':
				$user = $control->getByPrimaryKey("student_id", $member_id);
				break;
			case 'professor':
				$user = $control->getByPrimaryKey("professor_id", $member_id);
				break;
			case 'administrator':
				$user = $control->getByPrimaryKey("administrator_id", $member_id);
				break;
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
		$success = $member_control->updateAttribute($member, "last_login");
		
		return $success;
	}

	
	public function update_last_logout($member_id, $mdb_control)
	{
		$success = false;
		
		// MySQL DATETIME format
		$format = date("Y-m-d H:i:s");
		$logout_time = date($format, time());
		
		$member_control = $mdb_control->getController("member");
		$member = new Member();
		$member = $member_control->getByPrimaryKey("member_id", $member_id);
		$success = $member_control->updateAttribute($member, "last_logoff");
		
		return $success;
	}
	
	
}
	
?>