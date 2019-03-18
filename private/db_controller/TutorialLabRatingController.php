<?php



class TutorialLabRatingController extends DatabaseController {

	
	public function __construct() {}
	//($tutorial_lab_rating_id, $tutorial_lab_id, $member_id, $date_posted, $rating, $comments, $flag_for_review)
	

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating = new Tutorial_Lab_Rating();
				$rating->initialize($row['tutorial_lab_rating_id'], $row['tutorial_lab_id'], 
				$row['member_id'], $row['date_posted'], $row['rating'], $row['comments'], 
				$row['flag_for_review']);
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
	
	
	// The tutorial_lab_rating_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$tutorial_lab_rating)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$tutorial_lab_id = $tutorial_lab_rating->get_tutorial_lab_id();
		$member_id = $tutorial_lab_rating->get_member_id();
		$rating = $tutorial_lab_rating->get_rating();
		$comments = $tutorial_lab_rating->get_comments();
		$flag = $tutorial_lab_rating->get_flag_for_review();
		$table = $this->getTableName();
		
		// The tutorial_lab_rating_id will be auto-generated.
		$query = "insert into $table (tutorial_lab_id, member_id, date_posted, rating, comments, flag_for_review) 
				values('$tutorial_lab_id', '$member_id', 'now()', '$rating', '$comments', '$flag')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$rating->set_tutorial_lab_rating_id(mysql_insert_id($db_connection));	
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
	//($tutorial_lab_rating_id, $tutorial_lab_id, $member_id, $date_posted, $rating, $comments, $flag_for_review)
	public function updateAttribute($tutorial_lab_rating, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$tutorial_lab_rating_id = $tutorial_lab_rating->get_tutorial_lab_rating_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'tutorial_lab_rating_id':
				return false;
				break;
			case 'tutorial_lab_id':
				$value = $tutorial_lab_rating->get_tutorial_lab_id();
				$query = "update $table set tutorial_lab_id = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'member_id':
				$value = $tutorial_lab_rating->get_member_id();
				$query = "update $table set member_id = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'date_posted':	
				$value = $tutorial_lab_rating->get_date_posted();
				$query = "update $table set date_posted = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'rating':	
				$value = $tutorial_lab_rating->get_rating();
				$query = "update $table set rating = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'comments':
				$value = $tutorial_lab_rating->get_comments();
				$query = "update $table set comments = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'flag_for_review':
				$value = $tutorial_lab_rating->get_flag_for_review();
				$query = "update $table set flag_for_review = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
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

	
	public function updateAll($tutorial_lab_rating)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$tutorial_lab_rating_id = $tutorial_lab_rating->get_tutorial_lab_rating_id();
		
		// data to be updated			
		$tutorial_lab_id = $tutorial_lab_rating->get_tutorial_lab_id();
		$member_id = $tutorial_lab_rating->get_member_id();
		$date_posted = $tutorial_lab_rating->get_date_posted();
		$rating = $tutorial_lab_rating->get_rating();
		$comments = $tutorial_lab_rating->get_comments();
		$flag_for_review = $tutorial_lab_rating->get_flag_for_review();
			
		$query = "UPDATE $table 
					SET tutorial_lab_id = '$tutorial_lab_id',
						member_id = '$member_id',
						date_posted = '$date_posted',
						rating = '$rating',
						comments = '$comments',
						flag_for_review = '$flag_for_review'
					WHERE tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
	}
	
	
	public function deleteFromDatabase($tutorial_lab_rating)
	{
		$db_connection = get_db_connection();
		$success = true;
		$tutorial_lab_rating_id = $tutorial_lab_rating->get_tutorial_lab_rating_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where tutorial_lab_rating_id = $tutorial_lab_rating_id";
		
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