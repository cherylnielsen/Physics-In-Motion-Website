<?php


class Notice_View extends Notice{
	
	// the member who wrote and sent the notice
	private $from_first_name;
	private $from_last_name;
	private $from_member_type;

	
	public function __construct() {}
	
	public function initializeView($notice_id, $from_member_id, $date_sent, $notice_subject,
						$notice_text, $from_first_name, $from_last_name, $from_member_type,
						$response_to_notice_id = null, $flag_for_review = false)
	{
		$this->initialize($notice_id, $from_member_id, $date_sent, $notice_subject, 
							$notice_text, $response_to_notice_id, $flag_for_review);
		
		$this->from_first_name = $from_first_name; 
		$this->from_last_name = $from_last_name; 
		$this->from_member_type = $from_member_type;
	}


	public function get_from_first_name()
	{
		return $this->from_first_name;
	}

	public function set_from_first_name($from_first_name)
	{
		$this->from_first_name = $from_first_name;
	}
	
	public function get_from_last_name()
	{
		return $this->from_last_name;
	}

	public function set_from_last_name($from_last_name)
	{
		$this->from_last_name = $from_last_name;
	}
	
	public function get_from_member_type()
	{
		return $this->from_member_type;
	}

	public function set_from_member_type($from_member_type)
	{
		$this->from_member_type = $from_member_type;
	}

	
}

?>