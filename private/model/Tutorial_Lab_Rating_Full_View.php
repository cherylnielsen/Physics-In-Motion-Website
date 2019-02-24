<?php

class Tutorial_Lab_Rating_Full_View {
	
	private $tutorial_lab_rating_id; 
	private $tutorial_lab_id;
	private $tutorial_lab_name;
	private $member_name;	
	private $member_id;
	private $date_posted;
	private $rating;
	private $comments;
	private $flag_for_review;
	
	public function __construct() {}
	
	public function initialize($tutorial_lab_rating_id, $tutorial_lab_id, $member_id, 
					$tutorial_lab_name, $member_name, $date_posted, 
					$rating, $comments, $flag_for_review = false)
	{
		$this->tutorial_lab_rating_id = $tutorial_lab_rating_id;
		$this->tutorial_lab_id = $tutorial_lab_id;
		$this->tutorial_lab_name = $tutorial_lab_name;
		$this->member_name = $member_name;
		$this->member_id = $member_id;
		$this->date_posted = $date_posted;
		$this->rating = $rating;
		$this->comments = $comments;
	}

	
	public function get_tutorial_lab_rating_id()
	{
		return $this->tutorial_lab_rating_id;
	}

	public function set_tutorial_lab_rating_id($tutorial_lab_rating_id)
	{
		$this->tutorial_lab_rating_id = $tutorial_lab_rating_id;
	}
	
	public function get_tutorial_lab_id()
	{
		return $this->tutorial_lab_id;
	}

	public function set_tutorial_lab_id($tutorial_lab_id)
	{
		$this->tutorial_lab_id = $tutorial_lab_id;
	}
	
	public function get_member_id()
	{
		return $this->member_id;
	}

	public function set_member_id($member_id)
	{
		$this->member_id = $member_id;
	}
	
	public function get_tutorial_lab_name()
	{
		return $this->tutorial_lab_name;
	}

	public function set_tutorial_lab_name($tutorial_lab_name)
	{
		$this->tutorial_lab_name = $tutorial_lab_name;
	}
	
	public function get_member_name()
	{
		return $this->member_name;
	}

	public function set_member_name($member_name)
	{
		$this->member_name = $member_name;
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