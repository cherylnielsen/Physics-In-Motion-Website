<?php

class Quote {
	
	private $quote_id;
	private $author;
	private $quote_text;	
	private $month;
	private $year;
	
	public function __construct() {}

	public function initialize($quote_id, $author, $quote_text, $month, $year)
	{
		$this->quote_id = $quote_id;
		$this->author = $author;
		$this->quote_text = $quote_text;
		$this->month = $month;
		$this->year = $year;
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
	
	public function get_month()
	{
		return $this->month;
	}

	public function set_month($month)
	{
		$this->month = $month;
	}
	
	public function get_year()
	{
		return $this->year;
	}

	public function set_year($year)
	{
		$this->year = $year;
	}
	
	
}

?>