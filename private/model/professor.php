<?php

class Professor {
	
	private $school_name;

	public function __construct() {}
	
	public function get_school_name()
	{
		return $this->school_name;
	}

	public function set_school_name($school_name)
	{
		$this->school_name = $school_name;
	}
	
}

?>