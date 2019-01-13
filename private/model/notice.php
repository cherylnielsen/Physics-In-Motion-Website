<?php

class Notice {
	
	private $notice_id;
	private $to_user_id;
	private $from_user_id;
	private $date_sent;
	private $subject;
	private $notice_text;
	
	public function __construct() {}
	
	public function initialize($notice_id, $to_user_id, $from_user_id, $date_sent, $subject, $notice_text)
	{
		$this->notice_id = $notice_id;
		$this->to_user_id = $to_user_id;
		$this->from_user_id = $from_user_id;
		$this->date_sent = $date_sent;
		$this->subject = $subject;
		$this->notice_text = $notice_text;
	}
	
	
	public function get_notice_id()
	{
		return $this->notice_id;
	}

	public function set_notice_id($notice_id)
	{
		$this->notice_id = $notice_id;
	}
	
	public function get_to_user_id()
	{
		return $this->to_user_id;
	}

	public function set_to_user_id($to_user_id)
	{
		$this->to_user_id = $to_user_id;
	}
	
	public function get_from_user_id()
	{
		return $this->from_user_id;
	}

	public function set_from_user_id($from_user_id)
	{
		$this->from_user_id = $from_user_id;
	}
	
	public function get_date_sent()
	{
		return $this->date_sent;
	}

	public function set_date_sent($date_sent)
	{
		$this->date_sent = $date_sent;
	}
	
	public function get_notice_text()
	{
		return $this->notice_text;
	}

	public function set_notice_text($notice_text)
	{
		$this->notice_text = $notice_text;
	}
	
	public function get_subject()
	{
		return $this->subject;
	}

	public function set_subject($subject)
	{
		$this->subject = $subject;
	}
	
	
}

?>