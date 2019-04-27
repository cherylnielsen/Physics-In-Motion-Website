<?php

class Administrator {
	
	protected $administrator_id;	// key
	protected $admin_type;
	protected $allowed_admin_types = array();
	
	public function __construct() 
	{
		$this->allowed_admin_types = array("general", "none");
	}
	
	public function initialize($administrator_id, $admin_type)
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
	
	public function set_allowed_admin_types($allowed_admin_types)
	{
		$this->allowed_admin_types = $allowed_admin_types;
	}
	
	public function get_admin_type()
	{
		return $this->admin_type;
	}

	public function set_admin_type($admin_type)
	{
		// Make sure value is an allowed value.
		if(in_array($admin_type, $this->allowed_admin_types))
		{
			$this->admin_type = $admin_type;
		}
	}
	
}

?>