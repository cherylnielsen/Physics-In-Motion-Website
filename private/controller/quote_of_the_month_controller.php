<?php

require_once('../database-access.php');
require_once('../model/quote_of_the_month.php');

class quote_of_the_month_controller {

	public function quote_of_the_month_controller() {}


	public function get_all_quotes()
	{
		$quote_array = array();
		$query = 'select * from quote_of_the_month';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each quote_of_the_month object onto the end of the array
				$quote_array[] = new quote_of_the_month($row['quote_id'], $row['date_posted'], $row['author'], $row['quote']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return quote_array;

	}


	public function get_current_quote()
	{
		$quoted = new quote_of_the_month();
		$query = 'select * from quote_of_the_month 
		where (MONTH(date_posted) = MONTH(NOW())) AND (YEAR(date_posted) = YEAR(NOW()))';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each quote_of_the_month object onto the end of the array
				$quoted->initialize($row['quote_id'], $row['date_posted'], $row['author'], $row['quote']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return quoted;

	}


	public function save_new_quote($date_posted, $author, $quote_text)
	{
		$sucess = true;
		// The quote_id is not included, because it is set automatically by the database.
		$query = 'insert into quote_of_the_month (date_posted, author, quote) 
				values($date_posted, $author, $quote_text)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
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

}

?>