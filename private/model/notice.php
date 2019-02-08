<?php

class Notice {
	
	private $notice_id; // key 
	private $from_member_id;
	private $to_section_id;
	private $date_sent;
	private $notice_subject;
	private $notice_text;
	private $notice_attachment_array;
	
	public function __construct() {}
	
	public function initialize($notice_id, $from_member_id, $to_section_id, $date_sent, $notice_subject, $notice_text)
	{
		$this->notice_id = $notice_id;
		$this->from_member_id = $from_member_id;
		$this->to_section_id = $to_section_id;
		$this->date_sent = $date_sent;
		$this->notice_subject = $notice_subject;
		$this->notice_text = $notice_text;
		$this->notice_attachment_array = array();
	}
	
	public function get_notice_id()
	{
		return $this->notice_id;
	}

	public function set_notice_id($notice_id)
	{
		$this->notice_id = $notice_id;
	}
	
	public function get_from_member_id()
	{
		return $this->from_member_id;
	}

	public function set_from_member_id($from_member_id)
	{
		$this->from_member_id = $from_member_id;
	}
	
	public function get_to_section_id()
	{
		return $this->to_section_id;
	}

	public function set_to_section_id($to_section_id)
	{
		$this->to_section_id = $to_section_id;
	}
	
	public function get_date_sent()
	{
		return $this->date_sent;
	}

	public function set_date_sent($date_sent)
	{
		$this->date_sent = $date_sent;
	}
	
	public function get_notice_subject()
	{
		return $this->notice_subject;
	}

	public function set_notice_subject($notice_subject)
	{
		$this->notice_subject = $notice_subject;
	}
	
	public function get_notice_text()
	{
		return $this->notice_text;
	}

	public function set_notice_text($notice_text)
	{
		$this->notice_text = $notice_text;
	}
	
	public function get_attachment_array()
	{
		return $this->notice_attachment_array;
	}

	public function set_attachment_array($notice_attachment_array)
	{
		$this->notice_attachment_array = $notice_attachment_array;
	}
}

?>