<?php

class Administrator_Member_View {
	
	private $administrator_id;	// key
	private $first_name;
	private $last_name;
	private $email; 
	private $admin_type;
	private $allowed_admin_types = array('General');
	
	public function __construct() {}
	

	public function initialize($administrator_id, $first_name, $last_name, $email, $admin_type)
	{
		$this->set_administrator_id($administrator_id);
		$this->set_first_name($first_name);
		$this->set_last_name($last_name);
		$this->set_email($email);
		$this->set_admin_type($admin_type);		
	}
	
	
	public function get_administrator_id()
	{
		return $this->administrator_id;
	}

	public function set_administrator_id($administrator_id)
	{
		$this->administrator_id = $administrator_id;
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
	
	public function get_email()
	{
		return $this->email;
	}

	public function set_email($email)
	{
		$this->email = $email;
	}
	
	public function get_admin_type()
	{
		return $this->admin_type;
	}

	public function set_admin_type($admin_type)
	{
		// Make sure value is an allowed value, otherwise use the default value of "General".
		if(in_array($admin_type, $this->allowed_admin_types))
		{
			$this->admin_type = $admin_type;
		}
		else
		{
			$this->admin_type = "General";
		}
	}
	
	
}

?>