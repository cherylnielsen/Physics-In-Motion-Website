<?php



class LabRatingController extends DatabaseController {

	
	public function __construct() {}
	//($rating_id, $lab_id, $user_id, $date_posted, $rating, $comments)
	
	public function initialize()
	{
		$this->tableName = "lab_rating";
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating = new LabRating();
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['user_id'], 
							$row['date_posted'], $row['rating'], $row['comments']);
				// pushes each object onto the end of the array
				$dataArray[] = $rating;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	
	
	// The rating_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$rating)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$lab_id = $rating->get_lab_id();
		$user_id = $rating->get_user_id();
		$rating = $rating->get_rating();
		$comments = $rating->get_comments();
		
		// The rating_id will be auto-generated.
		$query = "insert into lab_rating (lab_id, user_id, date_posted, rating, comments) 
				values('$lab_id', '$user_id', 'now()', '$rating', '$comments')";
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


	// updates the given attribute with the new value in the database and in the lab_rating object
	//($rating_id, $lab_id, $user_id, $date_posted, $rating, $comments)
	public function update_attribute(&$lab_rating, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$rating_id = $lab_rating->get_rating_id();	
		
		switch ($attribute)
		{
			case $rating_id:
			case $lab_id:
			case $user_id:
				return false;
				break;
			case $date_posted:
				$lab_rating->set_date_posted($value);	
				$query = "update lab_rating set date_posted = '$value' where rating_id = '$rating_id'";
				break;
			case $rating:
				$lab_rating->set_rating($value);	
				$query = "update lab_rating set rating = '$value' where rating_id = '$rating_id'";
				break;
			case $comments:
				$lab_rating->set_comments($value);	
				$query = "update lab_rating set comments = '$value' where rating_id = '$rating_id'";
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

	
	public function delete_from_database($lab_rating)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$rating_id = $lab_rating->get_rating_id();
		
		$query = "delete from lab_rating where rating_id = $rating_id";
		
		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		
		mysqli_close($db_connection);
		return $success;
	}

}

?>