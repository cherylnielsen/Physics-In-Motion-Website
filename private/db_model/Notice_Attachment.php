<?php

class Notice_Attachment {
	
	private $notice_attachment_id; // key 
	private $notice_id;
	private $filename;
	private $filepath;
	
	public function __construct() {}
	
	public function initialize($notice_attachment_id, $notice_id, $filename, $filepath)
	{
		$this->notice_attachment_id = $notice_attachment_id;
		$this->notice_id = $notice_id;
		$this->filename = $filename;
		$this->filepath = $filepath;
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
	
	public function get_filename()
	{
		return $this->filename;
	}

	public function set_filename($filename)
	{
		$this->filename = $filename;
	}
	
	public function get_filepath()
	{
		return $this->filepath;
	}

	public function set_filepath($filepath)
	{
		$this->filepath = $filepath;
	}
	
	
}


?>