<?php

class Tutorial_Lab_Rating_View extends Tutorial_Lab_Rating {
	
	private $tutorial_lab_name;
	private $member_type;
	private $first_name;
	private $last_name;
	
	public function __construct() {}
	
	public function initialize($tutorial_lab_rating_id, $tutorial_lab_id, 
					$date_posted, $rating, $comments, $tutorial_lab_name, 
					$member_id, $member_type, $first_name, $last_name, 
					$flag_for_review = false)
	{
		$this->initialize($tutorial_lab_rating_id, $tutorial_lab_id, $member_id, 
					$date_posted, $rating, $comments, $flag_for_review)
		
		$this->tutorial_lab_name = $tutorial_lab_name;
		$this->member_type = $member_type;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
	}

	
	public function get_tutorial_lab_name()
	{
		return $this->tutorial_lab_name;
	}

	public function set_tutorial_lab_name($tutorial_lab_name)
	{
		$this->tutorial_lab_name = $tutorial_lab_name;
	}
	
	public function get_member_type()
	{
		return $this->member_type;
	}

	public function set_member_type($member_type)
	{
		$this->member_type = $member_type;
	}
	
	public function get_first_name()
	{
		return $this->first_name;
	}

	public function set_first_name($first_name)
	{
		$this->first_name = $first_name;
	}
	
	public function get_last_name()
	{
		return $this->last_name;
	}

	public function set_last_name($last_name)
	{
		$this->last_name = $last_name;
	}

	
}

?>