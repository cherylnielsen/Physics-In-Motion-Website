<?php

class Quote {
	
	private $quote_id;
	private $author;
	private $quote_text;	
	private $month_posted;
	private $year_posted;
	
	public function __construct() {}

	public function initialize($quote_id, $author, $quote_text, $month_posted, $year_posted)
	{
		$this->quote_id = $quote_id;
		$this->author = $author;
		$this->quote_text = $quote_text;
		$this->month_posted = $month_posted;
		$this->year_posted = $year_posted;
	}
	
	
	public function get_quote_id()
	{
		return $this->quote_id;
	}

	public function set_quote_id($quote_id)
	{
		$this->quote_id = $quote_id;
	}
	
	public function get_author()
	{
		return $this->author;
	}

	public function set_author($author)
	{
		$this->author = $author;
	}
	
	public function get_quote_text()
	{
		return $this->quote_text;
	}

	public function set_quote_text($quote_text)
	{
		$this->quote_text = $quote_text;
	}
	
	public function get_month_posted()
	{
		return $this->month_posted;
	}

	public function set_month_posted($month_posted)
	{
		$this->month_posted = $month_posted;
	}
	
	public function get_year_posted()
	{
		return $this->year_posted;
	}

	public function set_year_posted($year_posted)
	{
		$this->year_posted = $year_posted;
	}
	
	
}

?>