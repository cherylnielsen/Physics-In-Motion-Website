<?php

class Administrator {
	
	private $member_id;	// key
	private $first_name;
	private $last_name;
	private $admin_type;
	private $email; 
	
	public function __construct() {}
	

	public function initialize($member_id, $first_name, $last_name, $admin_type, $email)
	{
		$this->member_id = $member_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->admin_type = $admin_type;
		$this->email = $email;
	}
	

	public function get_member_id()
	{
		return $this->member_id;
	}

	public function set_member_id($member_id)
	{
		$this->member_id = $member_id;
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