<?php

class Notice_Attachment {
	
	private $notice_attachment_id; // key 
	private $notice_id;
	private $attachment;
	
	public function __construct() {}
	
	public function initialize($notice_attachment_id, $notice_id, $attachment)
	{
		$this->notice_attachment_id = $notice_attachment_id;
		$this->notice_id = $notice_id;
		$this->attachment = $attachment;
	}
	
	public function get_notice_attachment_id()
	{
		return $this->notice_attachment_id;
	}

	public function set_notice_attachment_id($notice_attachment_id)
	{
		$this->notice_attachment_id = $notice_attachment_id;
	}
	
	public function get_notice_id()
	{
		return $this->notice_id;
	}

	public function set_notice_id($notice_id)
	{
		$this->notice_id = $notice_id;
	}
	
	public function get_attachment()
	{
		return $this->attachment;
	}

	public function set_attachment($attachment)
	{
		$this->attachment = $attachment;
	}
	
	
}

?>