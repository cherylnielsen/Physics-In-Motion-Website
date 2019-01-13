<?php

require_once('model/Quote.php');
require_once('controller/DatabaseController.php');

class QuoteController extends DatabaseController {

	
	public function __construct() {}
	//Quote ($quote_id, $author, $quote_text, $month, $year)
	
	public function initialize()
	{
		$table = "quote";
		$this->setTableName($table);
	}

	private function getData($db_result, &$dataArray)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$quote = new Quote();
				$quote->initialize($row['quote_id'], $row['author'], $row['quote_text'],
							$row['month'], $row['year']);
				// pushes each object onto the end of the array
				$dataArray[] = $quote;
			}
			mysqli_free_result($db_result);
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	

	/***
	Queries the database for the quote with the current month and year.
	Input: $db_connection = the database connection.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getQuoteOfTheMonth()
	{
		$db_connection = $this->$get_db_connection();
		$dataArray = array();
		$quote = new Quote();
		
		$query = 'select * from quote where (month = MONTH(NOW())) AND (year = YEAR(NOW()))';
		$result = mysqli_query($db_connection, $query);
		getData($result, &$dataArray);
		mysqli_close($db_connection);
			
		if(count($dataArray) > 0)
		{
			$quote = $dataArray[0];
		}		
		
		return $quote;
	}


	public function saveNew($quote)
	{
		$sucess = true;
		$db_connection = $this->$get_db_connection();
		$date = $quote->get_date_posted();
		$author = $quote->get_author();
		$text = $quote->get_quote_text();
		
		// The quote_id is set automatically by the database.
		$query = "insert into quote (date_posted, author, quote_text) 
				values('$date', '$author', '$text')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$quote->set_quote_id(mysql_insert_id($db_connection));
			mysqli_free_result($result);					
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	

	public function update($quote)
	{
		$sucess = true;
		$db_connection = $this->$get_db_connection();
		$date = $quote->get_date_posted();
		$author = $quote->get_author();
		$text = $quote->get_quote_text();
		$id = $quote->get_quote_id();
		
		// The quote_id should not be changed.
		$query = "update quote set date_posted = '$date', author = '$author', 
					quote_text = '$text' where quote_id = '$id'";
				
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>