<?php



class LabRatingController extends DatabaseController {

	
	public function __construct() {}
	//($rating_id, $lab_id, $member_id, $date_posted, $rating, $comments)
	

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating = new LabRating();
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['member_id'], 
							$row['date_posted'], $row['rating'], $row['comments']);
				// pushes each object onto the end of the array
				$dataArray[] = $rating;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
			
		return $dataArray;
	}
	
	
	// The rating_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$rating)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$lab_id = $rating->get_lab_id();
		$member_id = $rating->get_member_id();
		$rating = $rating->get_rating();
		$comments = $rating->get_comments();
		$table = $this->getTableName();
		
		// The rating_id will be auto-generated.
		$query = "insert into $table (lab_id, member_id, date_posted, rating, comments) 
				values('$lab_id', '$member_id', 'now()', '$rating', '$comments')";
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
	//($rating_id, $lab_id, $member_id, $date_posted, $rating, $comments)
	public function updateAttribute(&$lab_rating, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$rating_id = $lab_rating->get_rating_id();	
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'rating_id':
			case 'lab_id':
			case 'member_id':
				return false;
				break;
			case 'date_posted':
				$lab_rating->set_date_posted($value);	
				$query = "update $table set date_posted = '$value' where rating_id = '$rating_id'";
				break;
			case 'rating':
				$lab_rating->set_rating($value);	
				$query = "update $table set rating = '$value' where rating_id = '$rating_id'";
				break;
			case 'comments':
				$lab_rating->set_comments($value);	
				$query = "update $table set comments = '$value' where rating_id = '$rating_id'";
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

	
	public function deleteFromDatabase($lab_rating)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$rating_id = $lab_rating->get_rating_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where rating_id = $rating_id";
		
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