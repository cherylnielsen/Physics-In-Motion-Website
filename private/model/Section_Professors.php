<?php

class Section_Professors {
	
	private $section_id;
	private $professor_id;
	
	public function __construct() {}
	
	public function initialize($section_id, $professor_id)
	{
		$this->section_id = $section_id;
		$this->professor_id = $professor_id;
	}
	
	
	public function get_section_id()
	{
		return $this->section_id;
	}

	public function set_section_id($section_id)
	{
		$this->section_id = $section_id;
	}
	
	public function get_professor_id()
	{
		return $this->professor_id;
	}

	public function set_professor_id($professor_id)
	{
		$this->professor_id = $professor_id;
	}
	
	
	
}

?>