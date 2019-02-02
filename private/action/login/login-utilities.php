<?php

class LoginUtilities
{		
	public function __construct() {}
	
	public function authenticate_login($username, $password, $mdb_control)
	{		
		$user_id = -1;
		
		// find in the database
		$user_control = $mdb_control->getController("users");
		$user = $user_control->get_by_login($username, $password);
		
		if(!is_null($user)) 
		{
			$user_id = $user->get_user_id();
		}
		
		return $user_id;
	}	
	
	
	public function update_last_login($user_id, $mdb_control)
	{
		if(!is_null($user)) 
		{
			// MySQL DATETIME format
			$format = date("Y-m-d H:i:s");
			$login_time = date($format, time());
			$user_id = $user->get_user_id();			
			$user_control->update_last_login($user_id, $login_time);
		}
	}
	
	
	public function get_member($user_id, &$member_type, $mdb_control)
	{
		$member = null;
		$typeArray = array('student', 'professor', 'administrator');
		
		for($i = 0; $i < count($typeArray); $i++)
		{
			$dataArray = array();	
			$control = $mdb_control->getController($typeArray[$i]);
			$dataArray = $control->getByAttribute("user_id", $user_id);
			
			if(!is_null($dataArray) AND count($dataArray) > 0)
			{
				$member_type = $typeArray[$i];
				$member = $dataArray[0];
				return $member;
			}
		}	

		return $member;
	}
	
}
	
?>