<?php

class Member {
	
	private $member_id;	// key
	private $member_type;
	private $member_name;
	private $member_password;
	private $date_registered;
	private $last_login;
	private $last_logoff;
	
	public function __construct() {}

	public function initialize($member_id, $member_type, $member_name, $member_password, 
							$date_registered, $last_login, $last_logoff)
	{
		$this->member_id = $member_id;
		$this->member_type = $member_type;
		$this->member_name = $member_name;
		$this->member_password = $member_password;
		$this->date_registered = $date_registered;
		$this->last_login = $last_login;
		$this->last_logoff = $last_logoff;
	}
	
	public function get_member_id()
	{
		return $this->member_id;
	}

	public function set_member_id($member_id)
	{
		$this->member_id = $member_id;
	}
	
	public function get_member_type()
	{
		return $this->member_type;
	}

	public function set_member_type($member_type)
	{
		$this->member_type = $member_type;
	}
	
	public function get_member_name()
	{
		return $this->member_name;
	}

	public function set_member_name($member_name)
	{
		$this->member_name = $member_name;
	}
	
	public function get_member_password()
	{
		return $this->member_password;
	}

	public function set_member_password($member_password)
	{
		$this->member_password = $member_password;
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
		return $this->last_login;
	}

	public function set_last_login($last_login)
	{
		$this->last_login = $last_login;
	}
	
	public function get_last_logoff()
	{
		return $this->last_logoff;
	}

	public function set_last_logoff($last_logoff)
	{
		$this->last_logoff = $last_logoff;
	}
	
}

?>