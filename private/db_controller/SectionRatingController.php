<?php



class SectionRatingController extends DatabaseController {

	
	public function __construct() {}
	//($section_rating_id, $section_id, $date_posted, $rating, $comments, $flag_for_review)
	

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating = new Section_Rating();
				$rating->initialize($row['section_rating_id'], $row['section_id'],  
							$row['date_posted'], $row['rating'], $row['comments'], 
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
	
	
	// The section_rating_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$rating)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$section_id = $rating->get_section_id();
		$rating = $rating->get_rating();
		$comments = $rating->get_comments();
		$flag = $rating->get_flag_for_review();
		$table = $this->getTableName();
		
		// The section_rating_id will be auto-generated.
		$query = "insert into $table (section_id, date_posted, rating, comments, flag_for_review) 
				values('$section_id', 'now()', '$rating', '$comments', '$flag')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$rating->set_section_rating_id(mysql_insert_id($db_connection));	
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


	// updates the given key with the new value in the database
	//($section_rating_id, $section_id, $member_id, $date_posted, $rating, $comments)
	public function updateAttribute($lab_rating, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_rating_id = $lab_rating->get_section_rating_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'section_rating_id':
				return false;
				break;
			case 'section_id':
				$value = $lab_rating->get_section_id();	
				$query = "update $table set section_id = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'date_posted':
				$value = $lab_rating->get_date_posted();	
				$query = "update $table set date_posted = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'rating':
				$value = $lab_rating->get_rating();	
				$query = "update $table set rating = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'comments':
				$value = $lab_rating->get_comments();	
				$query = "update $table set comments = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'flag_for_review':
				$value = $lab_rating->get_flag_for_review();	
				$query = "update $table set flag_for_review = '$value' where section_rating_id = '$section_rating_id'";
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
		$db_connection = get_db_connection();
		$success = true;
		$section_rating_id = $lab_rating->get_section_rating_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where section_rating_id = $section_rating_id";
		
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