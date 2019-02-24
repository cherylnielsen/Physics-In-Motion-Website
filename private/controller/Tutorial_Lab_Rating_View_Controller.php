<?php



class Tutorial_Lab_Rating_View_Controller extends DatabaseController {

	
	public function __construct() {}
	// ($tutorial_lab_rating_id, $tutorial_lab_id, $member_id, $tutorial_lab_name, $member_name, 
	// $date_posted, $rating, $comments, $flag_for_review)
	

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating = new Tutorial_Lab_Rating_View();
				$rating->initialize($row['tutorial_lab_rating_id'], $row['tutorial_lab_id'], $row['member_id'], 
							$row['tutorial_lab_name'], $row['member_name'], 
							$row['date_posted'], $row['rating'], $row['comments'], $row['flag_for_review']);
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
	public function saveNew(&$tutorial_lab_rating_view)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$tutorial_lab_id = $tutorial_lab_rating_view->get_tutorial_lab_id();
		$member_id = $tutorial_lab_rating_view->get_member_id();		
		$tutorial_lab_name = $tutorial_lab_rating_view->get_tutorial_lab_name();
		$member_name = $tutorial_lab_rating_view->get_member_name();		
		$rating = $tutorial_lab_rating_view->get_rating();
		$comments = $tutorial_lab_rating_view->get_comments();
		$flag = $tutorial_lab_rating_view->get_flag_for_review();
		$table = $this->getTableName();
		
		// The tutorial_lab_rating_id will be auto-generated.
		$query = "insert into $table (tutorial_lab_id, member_id, tutorial_lab_name, member_name, date_posted, rating, comments, flag_for_review) 
				values('$tutorial_lab_id', '$member_id', '$tutorial_lab_name', '$member_name', 'now()', '$rating', '$comments', '$flag')";
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

		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;
		
	}


	// updates the given key with the new value in the database
	// ($tutorial_lab_rating_id, $tutorial_lab_id, $member_id, $tutorial_lab_name, $member_name, 
	//  $date_posted, $rating, $comments)
	public function updateAttribute($tutorial_lab_rating_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$tutorial_lab_rating_id = $tutorial_lab_rating_view->get_tutorial_lab_rating_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'tutorial_lab_rating_id':
				return false;
				break;
			case 'tutorial_lab_id':
				$value = $tutorial_lab_rating_view->get_tutorial_lab_id();
				$query = "update $table set tutorial_lab_id = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'member_id':
				$value = $tutorial_lab_rating_view->get_member_id();
				$query = "update $table set member_id = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'tutorial_lab_name':
				$value = $tutorial_lab_rating_view->get_tutorial_lab_name();
				$query = "update $table set tutorial_lab_name = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'member_name':
				$value = $tutorial_lab_rating_view->get_member_name();
				$query = "update $table set member_name = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'date_posted':	
				$value = $tutorial_lab_rating_view->get_date_posted();
				$query = "update $table set date_posted = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'rating':	
				$value = $tutorial_lab_rating_view->get_rating();
				$query = "update $table set rating = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'comments':
				$value = $tutorial_lab_rating_view->get_comments();
				$query = "update $table set comments = '$value' where tutorial_lab_rating_id = '$tutorial_lab_rating_id'";
				break;
			case 'flag_for_review':
				$value = $tutorial_lab_rating_view->get_flag_for_review();
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

	
	public function deleteFromDatabase($tutorial_lab_rating_view)
	{
		$db_connection = get_db_connection();
		$success = true;
		$tutorial_lab_rating_id = $tutorial_lab_rating_view->get_tutorial_lab_rating_id();
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