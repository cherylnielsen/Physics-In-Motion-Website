<?php



class LabRatingController extends DatabaseController {

	public function __construct() {}
	//($rating_id, $lab_id, $user_id, $date_posted, $lab_rating, $comments)
	
	public function initialize()
	{
		$table = "lab_rating";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating = new LabRating();
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['user_id'], $row['date_posted'], $row['lab_rating'], $row['comments']);
				// pushes each object onto the end of the array
				$dataArray[] = $rating;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	
	
	// The rating_id must not be changed, so it is not updated.
	public function update($rating)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$rating_id = $rating->get_rating_id();
		$lab_id = $rating->get_lab_id();
		$user_id = $rating->get_user_id();
		$date_posted = $rating->$get_date_posted();
		$lab_rating = $rating->get_lab_rating();
		$comments = $rating->get_comments();
		
		// The rating_id must not be changed, so it is not updated.
		$query = "update lab_rating set lab_id = '$lab_id', user_id = '$user_id', date_posted = '$date_posted', 
				lab_rating = '$lab_rating', comments = '$comments' 
				where rating_id = '$rating_id'";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The lab_rating could not be updated.</p>';
		}

		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;

	}


	// The rating_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$rating)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$lab_id = $rating->get_lab_id();
		$user_id = $rating->get_user_id();
		$lab_rating = $rating->get_lab_rating();
		$comments = $rating->get_comments();
		
		// The rating_id will be auto-generated.
		$query = "insert into lab_rating (lab_id, user_id, date_posted, lab_rating, comments) 
				values('$lab_id', '$user_id', 'now()', '$lab_rating', '$comments')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$rating->set_rating_id(mysql_insert_id($db_connection));	
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


}

?>