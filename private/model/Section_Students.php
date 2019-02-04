<?php

class Section_Students {
	
	private $section_id;
	private $user_id;
	
	public function __construct() {}
	
	public function initialize($section_id, $user_id)
	{
		$this->section_id = $section_id;
		$this->user_id = $user_id;
	}
	
	
	public function get_section_id()
	{
		return $this->section_id;
	}

	public function set_section_id($section_id)
	{
		$this->section_id = $section_id;
	}
	
	public function get_user_id()
	{
		return $this->user_id;
	}

	public function set_user_id($user_id)
	{
		$this->user_id = $user_id;
	}
	
	
	
}

?>