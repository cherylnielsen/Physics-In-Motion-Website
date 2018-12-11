<?php

class Users {
	
	private $user_id;
	private $user_name;
	private $user_password;
	
	
	public function __construct() {}
	
	public function Users($user_id, $user_name, $user_password)
	{
		$this->user_id = $user_id;
		$this->user_name = $user_name;
		$this->user_password = $user_password;
	}

	public function initialize($user_id, $user_name, $user_password)
	{
		$this->user_id = $user_id;
		$this->user_name = $user_name;
		$this->user_password = $user_password;
	}
	
	public function get_user_id()
	{
		return $this->user_id;
	}

	public function set_user_id($user_id)
	{
		$this->user_id = $user_id;
	}
	
	public function get_user_name()
	{
		return $this->user_name;
	}

	public function set_user_name($user_name)
	{
		$this->user_name = $user_name;
	}
	
	public function get_user_password()
	{
		return $this->user_password;
	}

	public function set_user_password($user_password)
	{
		$this->user_password = $user_password;
	}
	
	
	
}

?>