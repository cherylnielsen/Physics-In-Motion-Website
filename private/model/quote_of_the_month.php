<?php

class quote_of_the_month {
	
	private $quote_id;
	private $date_posted;
	private $author;
	private $quote;
	
	public function quote_of_the_month() {}
	
	public function quote_of_the_month($quote_id, $date_posted, $author, $quote)
	{
		$this->quote_id = $quote_id;
		$this->date_posted = $date_posted;
		$this->author = $author;
		$this->quote = $quote;
	}

	public function initialize($quote_id, $date_posted, $author, $quote)
	{
		$this->quote_id = $quote_id;
		$this->date_posted = $date_posted;
		$this->author = $author;
		$this->quote = $quote;
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
	
	public function get_quote()
	{
		return $this->quote;
	}

	public function set_quote($quote)
	{
		$this->quote = $quote;
	}
	
}

?>