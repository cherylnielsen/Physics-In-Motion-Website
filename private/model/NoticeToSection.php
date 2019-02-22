<?php

class NoticeToSection {
	
	private $notice_id; 
	private $to_section_id; 
	
	public function __construct() {}
	
	public function initialize($notice_id, $to_section_id)
	{
		$this->notice_id = $notice_id;
		$this->to_section_id = $to_section_id;
	}
	
	
	public function get_notice_id()
	{
		return $this->notice_id;
	}

	public function set_notice_id($notice_id)
	{
		$this->notice_id = $notice_id;
	}
	
	public function get_to_section_id()
	{
		return $this->to_section_id;
	}

	public function set_to_section_id($to_section_id)
	{
		$this->to_section_id = $to_section_id;
	}

	
}

?>