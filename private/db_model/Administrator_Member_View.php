<?php

class Administrator_Member_View extends Administrator{
	
	private $first_name;
	private $last_name;
	private $email; 
	
	public function __construct() {}
	

	public function initializeView($administrator_id, $first_name, $last_name, 
					$email, $admin_type = "general")
	{
		$this->set_administrator_id($administrator_id);
		$this->set_first_name($first_name);
		$this->set_last_name($last_name);
		$this->set_email($email);
		$this->set_admin_type($admin_type);		
	}
	
	
	public function get_first_name()
	{
		return $this->first_name;
	}
	
	public function set_first_name($first_name)
	{
		$this->first_name = $first_name;
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