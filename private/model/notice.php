<?php

class Notice {
	
	private $notice_id;
	private $assignment_id;
	private $notice_type;
	private $date_sent;
	private $notice_text;
	
	public function Notice() {}
	
	public function Notice($notice_id, $assignment_id, $notice_type, $date_sent, $notice_text)
	{
		$this->notice_id = $notice_id;
		$this->assignment_id = $assignment_id;
		$this->notice_type = $notice_type;
		$this->date_sent = $date_sent;
		$this->notice_text = $notice_text;
	}

	public function initialize($notice_id, $assignment_id, $notice_type, $date_sent, $notice_text)
	{
		$this->notice_id = $notice_id;
		$this->assignment_id = $assignment_id;
		$this->notice_type = $notice_type;
		$this->date_sent = $date_sent;
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
	
	public function get_assignment_id()
	{
		return $this->assignment_id;
	}

	public function set_assignment_id($assignment_id)
	{
		$this->assignment_id = $assignment_id;
	}
	
	public function get_notice_type()
	{
		return $this->notice_type;
	}

	public function set_notice_type($notice_type)
	{
		$this->notice_type = $notice_type;
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
	
}

?>