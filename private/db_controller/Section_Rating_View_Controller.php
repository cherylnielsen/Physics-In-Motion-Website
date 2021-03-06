<?php



class Section_Rating_View_Controller extends DatabaseController {

	public function __construct(){}
	// ($section_id, $section_name, $start_date, $end_date, $professor_id, 
	// $professor_professor_first_name, $professor_professor_last_name, $school_name,
	// $section_rating_id, $date_posted, $rating, $comments, $flag_for_review)
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_rating_view = new Section_Rating_View();
				$section_rating_view->initializeRatingView($row['section_id'], 
							$row['section_name'], $row['start_date'], $row['end_date'], 
							$row['professor_id'], $row['professor_first_name'], 
							$row['professor_last_name'], $row['school_name'],
							$row['section_rating_id'], $row['date_posted'], $row['rating'], 
							$row['comments'], $row['flag_for_review']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_rating_view;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}

	
	// updates the given key with the new value in the database
	public function updateAttribute($section_rating_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_rating_id = $section_rating_view->get_section_rating_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'section_rating_id':
				return false;
				break;
			case 'section_id':
				$value = $section_rating_view->get_section_name();	
				$query = "update $table set section_name = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'section_name':
				$value = $section_rating_view->get_section_name();	
				$query = "update $table set section_name = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'start_date':
				$value = $section_rating_view->get_start_date();	
				$query = "update $table set start_date = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'end_date':
				$value = $section_rating_view->get_end_date();	
				$query = "update $table set end_date = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'professor_id':
				$value = $section_rating_view->get_professor_id();	
				$query = "update $table set professor_id = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'professor_first_name':
				$value = $section_rating_view->get_professor_first_name();	
				$query = "update $table set professor_first_name = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'professor_last_name':
				$value = $section_rating_view->get_professor_last_name();	
				$query = "update $table set professor_last_name = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'school_name':
				$value = $section_rating_view->get_school_name();	
				$query = "update $table set school_name = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'date_posted':
				$value = $section_rating_view->get_date_posted();	
				$query = "update $table set date_posted = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'rating':
				$value = $section_rating_view->get_rating();	
				$query = "update $table set rating = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'comments':
				$value = $section_rating_view->get_comments();	
				$query = "update $table set comments = '$value' where section_rating_id = '$section_rating_id'";
				break;
			case 'flag_for_review':
				$value = $section_rating_view->get_flag_for_review();	
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
 

	// database view objects do not do full updates
	// due to multiple tables being involved
	public function updateAll($section_rating_view)
	{
		return false;
	}
	
	
	// database view objects do new database entries
	// due to multiple tables being involved
	public function saveNew(&$section_rating_view)
	{
		return false;
	}


	// database view objects do not delete objects from the database
	// due to multiple tables being involved
	public function deleteFromDatabase($section_rating_view)
	{
		return false;
	}

}

?>