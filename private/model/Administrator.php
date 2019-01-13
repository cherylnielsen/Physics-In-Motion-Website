<?php

class Administrator {
	
	private $admin_id;
	private $user_id;
	private $first_name;
	private $last_name;
	private $admin_type;
	private $email; 
	
	public function __construct() {}
	

	public function initialize($admin_id, $user_id, $first_name, $last_name, $admin_type, $email)
	{
		$this->admin_id = $admin_id;
		$this->user_id = $user_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->admin_type = $admin_type;
		$this->email = $email;
	}
	
	public function get_admin_id()
	{
		return $this->admin_id;
	}

	public function set_admin_id($admin_id)
	{
		$this->admin_id = $admin_id;
	}
	
	public function get_user_id()
	{
		return $this->user_id;
	}

	public function set_user_id($user_id)
	{
		$this->user_id = $user_id;
	}
	
	public function get_first_name()
	{
		return $this->first_name;
	}

	public function set_first_name($first_name)
	{
		$this->first_name = $first_name;
	}
	
	public function get_last_name()
	{
		return $this->last_name;
	}

	public function set_last_name($last_name)
	{
		$this->last_name = $last_name;
	}
	
	public function get_admin_type()
	{
		return $this->admin_type;
	}

	public function set_admin_type($admin_type)
	{
		$this->admin_type = $admin_type;
	}
	
	public function get_email()
	{
		return $this->email;
	}

	public function set_email($email)
	{
		$this->email = $email;
	}
}

?>