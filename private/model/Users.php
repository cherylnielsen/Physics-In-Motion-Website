<?php

class Users {
	
	private $user_id;
	private $user_name;
	private $user_password;
	private $user_email; 
	private $date_joined;
	
	
	public function Users() {}
	
	public function Users($user_id, $user_name, $user_password, $user_email, $date_joined)
	{
		$this->user_id = $user_id;
		$this->user_name = $user_name;
		$this->user_password = $user_password;
		$this->user_email = $user_email;
		$this->date_joined = $date_joined;
	}

	public function initialize($user_id, $user_name, $user_password, $user_email, $date_joined)
	{
		$this->user_id = $user_id;
		$this->user_name = $user_name;
		$this->user_password = $user_password;
		$this->user_email = $user_email;
		$this->date_joined = $date_joined;
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
	
	public function get_user_email()
	{
		return $this->user_email;
	}

	public function set_user_email($user_email)
	{
		$this->user_email = $user_email;
	}
	
	public function get_date_joined()
	{
		return $this->date_joined;
	}

	public function set_date_joined($date_joined)
	{
		$this->date_joined = $date_joined;
	}
	
}

?>