<?php

require_once('../database-access.php');
require_once('../model/professor_lab_rating.php');

class professor_lab_rating_controller {

	public function professor_lab_rating_controller() {}


	public function get_rating_by_professor_and_lab_id($lab_id, $professor_id)
	{
		$rating = new professor_lab_rating();		
		$query = 'select * from professor_lab_rating where (lab_id = $lab_id) AND (professor_id = $professor_id)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['professor_id'], $row['date_posted'], 
				$row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$rating = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>professor_lab_rating not found.</p>';
		}

		mysqli_close($db_connection);
		return rating;

	}


	public function get_rating_set_by_lab_id($lab_id)
	{
		$rating = new professor_lab_rating();		
		$query = 'select * from professor_lab_rating where lab_id = $lab_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['professor_id'], $row['date_posted'], 
				$row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$rating = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>professor_lab_rating not found.</p>';
		}

		mysqli_close($db_connection);
		return rating;

	}


	public function update_rating($rating_id, $lab_id, $professor_id, $date_posted, $lab_rating, $comments)
	{
		$sucess = true;
		// The rating_id should not be changed.
		$query = 'update professor_lab_rating set lab_id = $lab_id, professor_id = $professor_id, date_posted = now(), 
					lab_rating = $lab_rating, comments = $comments
					where rating_id = $rating_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The professor_lab_rating could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function save_new_rating($lab_id, $professor_id, $lab_rating, $comments)
	{
		$sucess = true;
		// The rating_id is not included, because it is set automatically by the database.
		$query = 'insert into professor_lab_rating (lab_id, professor_id, date_posted, lab_rating, comments) 
				values($lab_id, $professor_id, now(), $lab_rating, $comments)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New professor_lab_rating could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>