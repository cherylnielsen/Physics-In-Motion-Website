<?php

class Administrator extends Member {
	
	private $admin_type;
	private $allowed_admin_types = array('General');
	
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