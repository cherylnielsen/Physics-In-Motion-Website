<?php



class QuoteController extends DatabaseController {

	
	public function __construct() {}
	//Quote ($quote_id, $author, $quote_text, $month_posted, $year_posted)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$quote = new Quote();
				$quote->initialize($row['quote_id'], $row['author'], $row['quote_text'],
							$row['month_posted'], $row['year_posted']);
				// pushes each object onto the end of the array
				$dataArray[] = $quote;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}
	

	/***
	Queries the database for the quote with the current month_posted and year_posted.
	Input: $db_connection = the database connection.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getQuoteOfTheMonth()
	{
		$db_connection = get_db_connection();
		$dataArray = array();
		$quote = new Quote();
		$table = $this->getTableName();
		
		$query = "select * from $table where (month_posted = MONTH(NOW())) AND (year_posted = YEAR(NOW()))";
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);

		mysqli_close($db_connection);
			
		if(count($dataArray) > 0)
		{
			$quote = $dataArray[0];
		}		
		
		return $quote;
	}


	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$quote)
	{
		$sucess = true;
		$db_connection = get_db_connection();
		$author = $quote->get_author();
		$text = $quote->get_quote_text();
		$month_posted = $quote->get_month_posted();
		$year_posted = $quote->get_year_posted();
		$table = $this->getTableName();
		
		// The id will be auto-generated, when the new object is added to the database table.
		$query = "insert into $table (author, quote_text, month_posted, year_posted) 
				values('$author', '$text', '$month_posted', '$year_posted')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$quote_id = mysqli_insert_id($db_connection);
			$quote->set_quote_id(quote_id);				
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	

	// updates the given key with the new value in the database
	public function updateAttribute($quote, $key)
	{
		//Quote ($quote_id, $author, $quote_text, $month_posted, $year_posted)
		$db_connection = get_db_connection();
		$success = true;
		$quote_id = $quote->get_quote_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'quote_id':
				return false;
				break;
			case 'author':
				$value = $quote->get_author();	
				$query = "update $table set author = '$value' where quote_id = '$quote_id'";
				break;
			case 'quote_text':
				$value = $quote->get_quote_text();	
				$query = "update $table set quote_text = '$value' where quote_id = '$quote_id'";
				break;
			case 'month_posted':
				$value = $quote->get_month_posted();	
				$query = "update $table set month_posted = '$value' where quote_id = '$quote_id'";
				break;
			case 'year_posted':
				$value = $quote->get_year_posted();	
				$query = "update $table set year_posted = '$value' where quote_id = '$quote_id'";
				break;
		}
		
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;		
	}

	
	public function updateAll($quote)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$quote_id = $quote->get_quote_id();	
				
		// data to be updated			
		$author = $quote->get_author();
		$quote_text = $quote->get_quote_text();
		$month_posted = $quote->get_month_posted();
		$year_posted = $quote->get_year_posted();
					
		$query = "UPDATE $table 
					SET author = '$author',
						quote_text = '$quote_text',
						month_posted = '$month_posted',
						year_posted = '$year_posted'
					WHERE quote_id = '$quote_id'";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
	}
	
	
	public function deleteFromDatabase($quote)
	{
		$db_connection = get_db_connection();
		$success = true;
		$quote_id = $quote->get_quote_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where quote_id = $quote_id";
		$result = mysqli_query($db_connection, $query);
		
		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		
		mysqli_close($db_connection);
		return $success;
	}
	

	/***
	Queries the database for an array of all rows in the database table.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getAllSortByDate()
	{
		$table = "";
		$table = $this->getTableName();
		$db_connection = get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table order by year_posted, month_posted";		
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);
		mysqli_close($db_connection);
		
		return $dataArray;
	}
	
	
	
	
}

?>