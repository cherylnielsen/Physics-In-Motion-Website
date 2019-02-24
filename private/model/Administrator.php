<?php

class Administrator {
	
	private $administrator_id;	// key
	private $admin_type;
	private $allowed_admin_types = array("general");
	
	public function __construct() {}
	
	public function initialize($administrator_id, $admin_type = "general")
	{
		$this->administrator_id = $administrator_id;
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
	
	public function get_allowed_admin_types()
	{
		return $this->allowed_admin_types;
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