<?php

require_once('../database-access.php');
require_once('../model/Quote.php');

class Quote_controller {

	public function Quote_controller() {}
	//Quote ($quote_id, $date_posted, $author, $quote_text)

	public function get_all_quotes()
	{
		$quote_array = array();
		$query = 'select * from quote';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$quote_array[] = new Quote($row['quote_id'], $row['date_posted'], $row['author'], $row['quote_text']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $quote_array;

	}


	public function get_current_quote()
	{
		$quoted = new Quote();
		$query = 'select * from quote where (MONTH(date_posted) = MONTH(NOW())) AND (YEAR(date_posted) = YEAR(NOW()))';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$quoted = new Quote($row['quote_id'], $row['date_posted'], $row['author'], $row['quote_text']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $quoted;

	}


	public function save_new_quote($quote)
	{
		$sucess = true;
		// The quote_id is set automatically by the database.
		$query = 'insert into quote (date_posted, author, quote_text) 
				values($quote->date_posted, $quote->author, $quote->quote_text)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$quote->quote_id = mysql_insert_id();
			mysqli_free_result($result);					
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New quote could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	

	public function update_quote($quote)
	{
		$sucess = true;
		// The quote_id should not be changed.
		$query = 'update quote set date_posted = $quote->date_posted, author = $quote->author, 
					quote = $quote->quote_text where quote_id = $quote->quote_id';
				
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>Quote could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}

}

?>