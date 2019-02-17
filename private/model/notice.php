<?php

class Notice {
	
	private $notice_id; // key 
	private $from_member_id;
	private $date_sent;
	private $notice_subject;
	private $notice_text;
	private $sent_high_priority;
	private $flag_for_review;
	
	public function __construct() {}
	
	public function initialize($notice_id, $from_member_id, $date_sent, $notice_subject, 
					$notice_text, $sent_high_priority = false, $flag_for_review = false)
	{
		$this->notice_id = $notice_id;
		$this->from_member_id = $from_member_id;
		$this->date_sent = $date_sent;
		$this->notice_subject = $notice_subject;
		$this->notice_text = $notice_text;
		$this->sent_high_priority = $sent_high_priority;
		$this->flag_for_review = $flag_for_review;
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
	
	public function get_sent_high_priority()
	{
		return $this->sent_high_priority;
	}

	public function set_sent_high_priority($sent_high_priority)
	{
		$this->sent_high_priority = $sent_high_priority;
	}
	
	public function get_flag_for_review()
	{
		return $this->flag_for_review;
	}

	public function set_flag_for_review($flag_for_review)
	{
		$this->flag_for_review = $flag_for_review;
	}
	
	
}

?>