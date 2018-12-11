<?php

class Quote {
	
	private $quote_id;
	private $date_posted;
	private $author;
	private $quote_text;
	
	public function __construct() {}
	
	public function Quote($quote_id, $date_posted, $author, $quote_text)
	{
		$this->quote_id = $quote_id;
		$this->date_posted = $date_posted;
		$this->author = $author;
		$this->quote_text = $quote_text;
	}

	public function initialize($quote_id, $date_posted, $author, $quote_text)
	{
		$this->quote_id = $quote_id;
		$this->date_posted = $date_posted;
		$this->author = $author;
		$this->quote_text = $quote_text;
	}
	
	public function get_quote_id()
	{
		return $this->quote_id;
	}

	public function set_quote_id($quote_id)
	{
		$this->quote_id = $quote_id;
	}
	
	public function get_date_posted()
	{
		return $this->date_posted;
	}

	public function set_date_posted($date_posted)
	{
		$this->date_posted = $date_posted;
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
	
}

?>