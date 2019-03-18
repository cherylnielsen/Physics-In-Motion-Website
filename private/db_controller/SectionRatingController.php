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
				$section_rating = new Section_Rating();
				$section_rating->initialize($row['section_rating_id'], $row['section_id'],  
							$row['date_posted'], $row['rating'], $row['comments'], 
							$row['flag_for_review']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_rating;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
			
		return $dataArray;
	}
	
	
	// The section_rating_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$section_rating)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$section_id = $section_rating->get_section_id();
		$rating = $section_rating->get_rating();
		$comments = $section_rating->get_comments();
		$flag = $section_rating->get_flag_for_review();
		$table = $this->getTableName();
		
		// The section_rating_id will be auto-generated.
		$query = "insert into $table (section_id, date_posted, rating, comments, flag_for_review) 
				values('$section_id', 'now()', '$rating', '$comments', '$flag')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$section_rating->set_section_rating_id(mysql_insert_id($db_connection));	
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
	//($section_rating_id, $section_id, $member_id, $date_posted, $rating, $comments)
	public function updateAttribute($section_rating, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_rating_id = $section_rating->get_section_rating_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'section_rating_id':
				return false;
				break;
			case 'section_id':
				$value = $section_rating->get_section_id();	
				$query = "update $table set section_id = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'date_posted':
				$value = $section_rating->get_date_posted();	
				$query = "update $table set date_posted = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'rating':
				$value = $section_rating->get_rating();	
				$query = "update $table set rating = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'comments':
				$value = $section_rating->get_comments();	
				$query = "update $table set comments = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'flag_for_review':
				$value = $section_rating->get_flag_for_review();	
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

	
	public function updateAll($section_rating)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$section_rating_id = $section_rating->get_section_rating_id();	
				
		// data to be updated			
		$section_id = $section_rating->get_section_id();
		$date_posted = $section_rating->get_date_posted();
		$comments = $section_rating->get_comments();
		$flag_for_review = $section_rating->get_flag_for_review();
					
		$query = "UPDATE $table 
					SET section_id = '$section_id',
						date_posted = '$date_posted',
						comments = '$comments',
						flag_for_review = '$flag_for_review'
					WHERE section_rating_id = '$section_rating_id'";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
	}
	
	
	public function deleteFromDatabase($section_rating)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_rating_id = $section_rating->get_section_rating_id();
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