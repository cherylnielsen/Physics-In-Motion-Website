<?php

class Administrator_Member_View  {
	
	private $administrator_id;	// key
	private $administrator_name;
	private $email; 
	private $admin_type;
	private $allowed_admin_types = array("general");
	
	public function __construct() {}
	

	public function initialize($administrator_id, $administrator_name, $email, $admin_type = "general")
	{
		$this->set_administrator_id($administrator_id);
		$this->set_administrator_name($administrator_name);
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
	
	public function get_administrator_name()
	{
		return $this->administrator_name;
	}
	
	public function set_administrator_name($administrator_name)
	{
		$this->administrator_name = $administrator_name;
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
		// Make sure value is an allowed value, otherwise use the default value of "general".
		if(in_array($admin_type, $this->allowed_admin_types))
		{
			$this->admin_type = $admin_type;
		}
		else
		{
			$this->admin_type = "general";
		}
	}
	
	
}

?>