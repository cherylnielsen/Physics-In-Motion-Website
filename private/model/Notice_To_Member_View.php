<?php


class Notice_To_Member_View {
	
	private $notice_id; // key 
	// the member who wrote and sent the notice
	private $from_member_id;
	// a member who received the notice
	private $to_member_id;
	
	// the date the notice was sent
	private $date_sent;
	// what the notice is about
	private $notice_subject;
	// the contents of the notice
	private $notice_text;
	
	// flag for high priority by the member who wrote and sent the notice
	private $sent_high_priority;
	// flag that the receiving member read the notice
	private $flag_read;
	// flag as important by the member who received the notice
	private $flag_important;
	// flag notice for questionable content, to be reviewed by administrator
	private $flag_for_review;
	
	
	public function __construct() {}
	
	public function initialize($notice_id, $from_member_id, $to_member_id, $date_sent, $notice_subject, $notice_text, 
					$sent_high_priority = false, $flag_read = false, $flag_important = false, $flag_for_review = false, )
	{
		$this->notice_id = $notice_id;
		$this->from_member_id = $from_member_id;
		$this->to_member_id = $to_member_id;
		$this->date_sent = $date_sent;
		$this->notice_subject = $notice_subject;
		$this->notice_text = $notice_text;
		// the flags will all default to false if not set in the initialize parameters
		$this->sent_high_priority = $sent_high_priority;
		$this->flag_read = $flag_read;
		$this->flag_important = $flag_important;
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
	
	public function get_to_member_id()
	{
		return $this->to_member_id;
	}

	public function set_to_member_id($to_member_id)
	{
		$this->to_member_id = $to_member_id;
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

	public function set_flag_important($flag_for_review)
	{
		$this->flag_important = $flag_important;
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