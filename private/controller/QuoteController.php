<?php



class QuoteController extends DatabaseController {

	
	public function __construct() {}
	//Quote ($quote_id, $author, $quote_text, $month_posted, $year_posted)
	
	public function initialize()
	{
		$table = "quote";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
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
	}
	

	/***
	Queries the database for the quote with the current month_posted and year_posted.
	Input: $db_connection = the database connection.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getQuoteOfTheMonth()
	{
		$db_connection = $this->get_db_connection();
		$dataArray = array();
		$quote = new Quote();
		
		$query = 'select * from quote where (month_posted = MONTH(NOW())) AND (year_posted = YEAR(NOW()))';
		$result = mysqli_query($db_connection, $query);
		$this->getData($result, $dataArray, $db_connection);
		mysqli_free_result($result);
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
		$db_connection = $this->get_db_connection();
		$author = $quote->get_author();
		$text = $quote->get_quote_text();
		$month_posted = $quote->get_month_posted();
		$year_posted = $quote->get_year_posted();
		
		// The id will be auto-generated, when the new object is added to the database table.
		$query = "insert into quote (author, quote_text, month_posted, year_posted) 
				values('$author', '$text', '$month_posted', '$year_posted')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$quote_id = mysql_insert_id($db_connection);
			$quote->set_quote_id(quote_id);				
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;
		
	}
	

	// The id must not be changed, so it is not updated.
	public function update($quote)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$month_posted = $quote->get_month_posted_posted();
		$author = $quote->get_author();
		$text = $quote->get_quote_text();
		$quote_id = $quote->get_quote_id();
		
		// The id must not be changed, so it is not updated.
		$query = "update quote set month_posted_posted = '$month_posted', author = '$author', 
					quote_text = '$text' where quote_id = '$quote_id'";
				
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>