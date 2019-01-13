<?php

class Users {
	
	private $user_id;
	private $user_name;
	private $user_password;
	private $date_registered;
	private $last_login;
	
	public function __construct() {}

	public function initialize($user_id, $user_name, $user_password, $date_registered, $last_login)
	{
		$this->user_id = $user_id;
		$this->user_name = $user_name;
		$this->user_password = $user_password;
		$this->date_registered = $date_registered;
		$this->last_login = $last_login;
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
	
	public function get_date_registered()
	{
		return $this->date_registered;
	}

	public function set_date_registered($date_registered)
	{
		$this->date_registered = $date_registered;
	}
	
	public function get_last_login()
	{
		return $this->user_password;
	}

	public function set_last_login($last_login)
	{
		$this->last_login = $last_login;
	}
	
	
}

?>