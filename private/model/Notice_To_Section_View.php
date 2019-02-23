<?php


class Notice_To_Section_View extends Notice_To_Member_View {
		
	// a section who received the notice
	private $to_section_id;
	
	public function __construct() {}
	
	
	public function get_to_section_id()
	{
		return $this->to_section_id;
	}

	public function set_to_section_id($to_section_id)
	{
		$this->to_section_id = $to_section_id;
	}
	
	
}

?>