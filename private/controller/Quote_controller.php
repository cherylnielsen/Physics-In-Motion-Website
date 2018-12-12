<?php



class Quote_controller extends DatabaseController {


	public function __construct() {}
	//Quote ($quote_id, $date_posted, $author, $quote_text)


	public function get_by_id($id_number, $id_type, $db_connection)
	{
		$quote_array = array();
		$quote_array[] = get_by_attribute($id_number, $id_type);
		return $quote_array;
	}


	public function get_by_attribute($attribute_value, $attribute_type, $db_connection)
	{
		$quote_array = array();
		$query = 'select * from quote where $attribute_type = $attribute_value';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$the_quote = new Quote();
				$the_quote->initialize($row['quote_id'], $row['date_posted'], $row['author'], $row['quote_text']);
				// pushes each object onto the end of the array
				$quote_array[] = $the_quote;
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
	

	public function get_all($db_connection)
	{
		$quote_array = array();
		$query = 'select * from quote';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$the_quote = new Quote();
				$the_quote->initialize($row['quote_id'], $row['date_posted'], $row['author'], $row['quote_text']);
				// pushes each object onto the end of the array
				$quote_array[] = $the_quote;
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


	public function get_quote_of_the_month($db_connection)
	{
		$quote_of_the_month = new Quote();
		$query = 'select * from quote where (MONTH(date_posted) = MONTH(NOW())) AND (YEAR(date_posted) = YEAR(NOW()))';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$quote_of_the_month->initialize($row['quote_id'], $row['date_posted'], $row['author'], $row['quote_text']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $quote_of_the_month;

	}


	public function save_new($quote, $db_connection)
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
	

	public function update($quote, $db_connection)
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