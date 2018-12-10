<?php

class Tutorial_lab_rating {
	
	private $rating_id;
	private $lab_id;
	private $user_id;
	private $date_posted;
	private $lab_rating;
	private $comments;
	
	public function Tutorial_lab_rating() {}
	
	public function Tutorial_lab_rating($rating_id, $lab_id, $user_id, $date_posted, $lab_rating, $comments)
	{
		$this->rating_id = $rating_id;
		$this->lab_id = $lab_id;
		$this->user_id = $user_id;
		$this->date_posted = $date_posted;
		$this->lab_rating = $lab_rating;
		$this->comments = $comments;
	}
	
	public function initialize($rating_id, $lab_id, $user_id, $date_posted, $lab_rating, $comments)
	{
		$this->rating_id = $rating_id;
		$this->lab_id = $lab_id;
		$this->user_id = $user_id;
		$this->date_posted = $date_posted;
		$this->lab_rating = $lab_rating;
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
	
	public function get_user_id()
	{
		return $this->user_id;
	}

	public function set_user_id($user_id)
	{
		$this->user_id = $user_id;
	}
	
	public function get_date_posted()
	{
		return $this->date_posted;
	}

	public function set_date_posted($date_posted)
	{
		$this->date_posted = $date_posted;
	}
	
	public function get_lab_rating()
	{
		return $this->lab_rating;
	}

	public function set_lab_rating($lab_rating)
	{
		$this->lab_rating = $lab_rating;
	}
	
	public function get_comments()
	{
		return $this->comments;
	}

	public function set_comments($comments)
	{
		$this->comments = $comments;
	}
	
	
}

?>