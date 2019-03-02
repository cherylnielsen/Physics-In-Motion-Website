<?php

class Section_Rating_View extends Section_View {
	
	private $Section_Rating;
		
	public function __construct() {}
	
	public function initializeView($section_id, $section_name, $start_date, $end_date,
						$professor_id, $professor_first_name, $professor_last_name, $school_name, $section_rating_id, $date_posted, 
						$rating, $comments, $flag_for_review = false)
	{
		$this->initializeView($section_id, $section_name, $start_date, $end_date,
								$professor_id, $professor_first_name, $professor_last_name, $school_name)
					
		$this->Section_Rating = new Section_Rating();
		$this->Section_Rating->initialize($section_rating_id, $section_id, $date_posted, 
											$rating, $comments, $flag_for_review);
	}

	
	public function get_section_rating_id()
	{
		return $this->Section_Rating->get_section_rating_id();
	}

	public function set_section_rating_id($section_rating_id)
	{
		$this->Section_Rating->set_section_rating_id($section_rating_id);
	}
	
	public function get_section_id()
	{
		return $this->section_id();
	}

	public function set_section_id($section_id)
	{
		$this->Section_Rating->set_section_id($section_id);
		$this->set_section_id($section_id);
	}
	
	public function get_date_posted()
	{
		return $this->Section_Rating->get_date_posted();
	}

	public function set_date_posted($date_posted)
	{
		$this->Section_Rating->set_date_posted($date_posted);
	}
	
	public function get_rating()
	{
		return $this->Section_Rating->get_rating();
	}

	public function set_rating($rating)
	{
		$this->Section_Rating->set_rating($rating);
	}
	
	public function get_comments()
	{
		return $this->Section_Rating->get_comments();
	}

	public function set_comments($comments)
	{
		$this->Section_Rating->set_comments($comments);
	}
	
	public function get_flag_for_review()
	{
		return $this->Section_Rating->get_flag_for_review();
	}

	public function set_flag_for_review($flag_for_review)
	{
		$this->Section_Rating->set_flag_for_review($flag_for_review);
	}
	
	
}

?>