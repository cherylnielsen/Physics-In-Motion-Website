<?php


class Notice_View {
	
	private $notice_id; // key 
	// the member who wrote and sent the notice
	private $from_member_id;
	// the member who wrote and sent the notice
	private $from_member_name;
	// a member who received the notice
	private $to_member_id;
	// a section who received the notice
	private $to_section_id;
	
	// the date the notice was sent
	private $date_sent;
	// what the notice is about
	private $notice_subject;
	// the contents of the notice
	private $notice_text;
	// part of a notice chain
	private $response_to_notice_id;
	
	// flag notice for questionable content, to be reviewed by administrator
	private $flag_for_review;
	
	
	public function __construct() {}
	
	public function initialize($notice_id, $from_member_id, $from_member_name, $to_member_id, 
								$date_sent, $notice_subject, $notice_text, 
								$response_to_notice_id = null, $to_section_id = null, $flag_for_review = false)
	{
		$this->notice_id = $notice_id;
		$this->from_member_id = $from_member_id;
		$this->to_member_id = $to_member_id;
		$this->to_section_id = $to_section_id;
		
		$this->date_sent = $date_sent;
		$this->notice_subject = $notice_subject;
		$this->notice_text = $notice_text;
		$this->response_to_notice_id = $response_to_notice_id;

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
	
	public function get_response_to_notice_id()
	{
		return $this->response_to_notice_id;
	}

	public function set_response_to_notice_id($response_to_notice_id)
	{
		$this->response_to_notice_id = $response_to_notice_id;
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