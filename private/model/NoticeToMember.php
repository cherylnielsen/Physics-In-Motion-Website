<?php

class NoticeToMember {
	
	private $notice_id; 
	private $to_member_id; 
	
	public function __construct() {}
	
	public function initialize($notice_id, $to_member_id)
	{
		$this->notice_id = $notice_id;
		$this->to_member_id = $to_member_id;
	}

	
	public function get_notice_id() 
	{
		return $this->notice_id;
	}

	public function set_notice_id($notice_id)
	{
		$this->notice_id = $notice_id;
	}
	
	public function get_to_member_id()
	{
		return $this->to_member_id;
	}

	public function set_to_member_id($to_member_id)
	{
		$this->to_member_id = $to_member_id;
	}
	
}

?>