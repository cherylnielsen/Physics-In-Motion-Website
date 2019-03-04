<?php

class Tutorial_Lab_Rating {
	
	protected $tutorial_lab_rating_id; // key
	protected $tutorial_lab_id;
	protected $member_id;
	protected $date_posted;
	protected $rating;
	protected $comments;
	protected $flag_for_review;
	
	public function __construct() {}
	
	public function initialize($tutorial_lab_rating_id, $tutorial_lab_id, $member_id, 
					$date_posted, $rating, $comments, $flag_for_review = false)
	{
		$this->tutorial_lab_rating_id = $tutorial_lab_rating_id;
		$this->tutorial_lab_id = $tutorial_lab_id;
		$this->member_id = $member_id;
		$this->date_posted = $date_posted;
		$this->rating = $rating;
		$this->comments = $comments;
		$this->flag_for_review = $flag_for_review;
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