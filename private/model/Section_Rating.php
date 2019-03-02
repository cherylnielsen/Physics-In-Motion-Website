<?php

class Section_Rating {
	
	proteted $section_rating_id; // key
	proteted $section_id;
	proteted $date_posted;
	proteted $rating;
	proteted $comments;
	proteted $flag_for_review;
	
	public function __construct() {}
	
	public function initialize($section_rating_id, $section_id, $date_posted, 
					$rating, $comments, $flag_for_review = false)
	{
		$this->section_rating_id = $section_rating_id;
		$this->section_id = $section_id;
		$this->member_id = $member_id;
		$this->date_posted = $date_posted;
		$this->rating = $rating;
		$this->comments = $comments;
	}

	
	public function get_section_rating_id()
	{
		return $this->section_rating_id;
	}

	public function set_section_rating_id($section_rating_id)
	{
		$this->section_rating_id = $section_rating_id;
	}
	
	public function get_section_id()
	{
		return $this->section_id;
	}

	public function set_section_id($section_id)
	{
		$this->section_id = $section_id;
	}
	
	public function get_date_posted()
	{
		return $this->date_posted;
	}

	public function set_date_posted($date_posted)
	{
		$this->date_posted = $date_posted;
	}
	
	public function get_rating()
	{
		return $this->rating;
	}

	public function set_rating($rating)
	{
		$this->rating = $rating;
	}
	
	public function get_comments()
	{
		return $this->comments;
	}

	public function set_comments($comments)
	{
		$this->comments = $comments;
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