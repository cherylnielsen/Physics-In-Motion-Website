<?php

require_once('model/Lab_Rating.php');
require_once('controller/DatabaseController.php');

class LabRatingController extends DatabaseController {

	public function __construct() {}
	//($rating_id, $lab_id, $user_id, $date_posted, $lab_rating, $comments)
	
	public function initialize()
	{
		$table = "lab_rating";
		$this->setTableName($table);
	}

	private function getData($db_result, &$dataArray)
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
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	
	
	public function update($rating)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$lab_id = $rating->get_lab_id();
		$user_id = $rating->get_user_id();
		$lab_rating = $rating->get_lab_rating();
		$comments = $rating->get_comments();
		
		// The rating_id should not be changed.
		$query = "update lab_rating set lab_id = '$lab_id', user_id = '$user_id', date_posted = 'now()', lab_rating = '$lab_rating', comments = '$comments' where rating_id = '$rating_id'";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The lab_rating could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function saveNew($rating)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$lab_id = $rating->get_lab_id();
		$user_id = $rating->get_user_id();
		$lab_rating = $rating->get_lab_rating();
		$comments = $rating->get_comments();
		
		// The rating_id is not included, because it is set automatically by the database.
		$query = "insert into lab_rating (lab_id, user_id, date_posted, lab_rating, comments) 
				values('$lab_id', '$user_id', 'now()', '$lab_rating', '$comments')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$rating->set_rating_id(mysql_insert_id($db_connection));
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New lab_rating could not be saveNewd.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>