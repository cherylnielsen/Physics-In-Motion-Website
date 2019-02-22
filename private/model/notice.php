<?php

require_once('NoticeToMember.php');
require_once('NoticeToSection.php');
require_once('Notice_Attachment.php');


class Notice {
	
	private $notice_id; // key 
	// the member who wrote the notice
	private $from_member_id;
	private $date_sent;
	private $notice_subject;
	private $notice_text;
	// flag for high priority can be set when the notice is made
	private $sent_high_priority;
	// flag for questionable notice content, can be set by any member
	private $flag_for_review;
	
	// additional information from other database tables
	
	// array of section ids that the notice was sent to
	private $sent_to_sections = array();
	// array of member ids that the notice was sent to and the flags those members set
	private $sent_to_members = array();
	// array of attachments that were sent with the notice
	private $attachments = array();
	
	
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
	
	public function get_sent_to_sections()
	{
		return $this->sent_to_sections;
	}

	public function set_sent_to_sections($sent_to_sections)
	{
		$this->sent_to_sections = array();
		$this->sent_to_sections = $sent_to_sections;
	}
	
	public function get_sent_to_members()
	{
		return $this->sent_to_members;
	}

	public function set_sent_to_members($sent_to_members)
	{
		$this->sent_to_members = array();
		$this->sent_to_members = $sent_to_members;
	}
	
	public function get_attachments()
	{
		return $this->attachments;
	}

	public function set_attachments($attachments)
	{
		$this->attachments = array();
		$this->attachments = $attachments;
	}
	
}

?>