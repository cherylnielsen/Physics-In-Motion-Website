<?php

class Assignment_Attachment {
	
	private $assignment_attachment_id; // key 
	private $assignment_id;
	private $filename;
	private $filepath;
	
	public function __construct() {}
	
	public function initialize($assignment_attachment_id, $assignment_id, $filename, $filepath)
	{
		$this->assignment_attachment_id = $assignment_attachment_id;
		$this->assignment_id = $assignment_id;
		$this->filename = $filename;
		$this->filepath = $filepath;
	}
	
	
	public function get_assignment_attachment_id()
	{
		return $this->assignment_attachment_id;
	}

	public function set_assignment_attachment_id($assignment_attachment_id)
	{
		$this->assignment_attachment_id = $assignment_attachment_id;
	}
	
	public function get_assignment_id()
	{
		return $this->assignment_id;
	}

	public function set_assignment_id($assignment_id)
	{
		$this->assignment_id = $assignment_id;
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