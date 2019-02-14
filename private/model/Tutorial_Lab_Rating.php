<?php

class Tutorial_Lab_Rating {
	
	private $rating_id; // key
	private $lab_id;
	private $member_id;
	private $date_posted;
	private $rating;
	private $comments;
	private $flag_for_review;
	
	public function __construct() {}
	
	public function initialize($rating_id, $lab_id, $member_id, $date_posted, 
					$rating, $comments, $flag_for_review = false)
	{
		$this->rating_id = $rating_id;
		$this->lab_id = $lab_id;
		$this->member_id = $member_id;
		$this->date_posted = $date_posted;
		$this->rating = $rating;
		$this->comments = $comments;
	}

	public function get_rating_id()
	{
		return $this->rating_id;
	}

	public function set_rating_id($rating_id)
	{
		$this->rating_id = $rating_id;
	}
	
	public function get_lab_id()
	{
		return $this->lab_id;
	}

	public function set_lab_id($lab_id)
	{
		$this->lab_id = $lab_id;
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