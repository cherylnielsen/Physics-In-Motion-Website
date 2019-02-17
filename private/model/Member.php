<?php

class Member {
	
	private $member_id;	// key
	private $first_name;
	private $last_name;
	private $email; 
	private $member_type;
	private $allowed_member_types = array('professor', 'student', 'administrator', 'blocked');
	private $member_name;
	private $member_password;
	private $date_registered;
	private $last_login;
	private $last_logoff;
	private $registration_complete;
	
	public function __construct() {}
	

	public function initialize($member_id, $member_type, $member_name, $member_password, 
								$date_registered, $last_login, $last_logoff, 
								$first_name, $last_name, $email, $registration_complete = false)
	{
		$this->set_member_id($member_id);
		$this->set_member_type($member_type);
		$this->set_member_name($member_name);
		$this->set_member_password($member_password);
		$this->set_date_registered($date_registered);
		$this->set_last_login($last_login);
		$this->set_last_logoff($last_logoff);
		$this->set_first_name($first_name);
		$this->set_last_name($last_name);
		$this->set_email($email);	
		$this->set_registration_complete($registration_complete);
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
		// Make sure value is an allowed value.
		if(in_array($member_type, $this->allowed_member_types))
		{
			$this->member_type = $member_type;
		}
		else
		{
			$this->member_type = "error";
		}
	}
	
	public function get_first_name()
	{
		return $this->first_name;
	}
	
	public function get_email()
	{
		return $this->email;
	}

	public function set_email($email)
	{
		$this->email = $email;
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
	
	public function get_registration_complete()
	{
		return $this->registration_complete;
	}

	public function set_registration_complete($registration_complete)
	{
		$this->registration_complete = $registration_complete;
	}
	
	
}

?>