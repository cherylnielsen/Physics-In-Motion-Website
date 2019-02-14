<?php

class Notice_Received {
	
	private $notice_id; // key 
	private $to_member_id;
	private $flag_read;
	private $flag_important;
	
	public function __construct() {}
	
	public function initialize($notice_id, $to_member_id, $flag_read = false, $flag_important = false)
	{
		$this->notice_id = $notice_id;
		$this->to_member_id = $to_member_id;
		$this->flag_read = $flag_read;
		$this->flag_important = $flag_important;
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

	public function get_flag_read()
	{
		return $this->flag_read;
	}

	public function set_flag_read($flag_read)
	{
		$this->flag_read = $flag_read;
	}
	
	public function get_flag_important()
	{
		return $this->flag_important;
	}

	public function set_flag_important($flag_important)
	{
		$this->flag_important = $flag_important;
	}
	
	
}

?>