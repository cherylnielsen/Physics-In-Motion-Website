<?php

require_once('../database-access.php');
require_once('../model/Tutorial_lab_rating.php');

class Tutorial_lab_rating_controller {

	public function Tutorial_lab_rating_controller() {}
	//($rating_id, $lab_id, $user_id, $date_posted, $lab_rating, $comments)
	
	public function get_rating_by_id($rating_id)
	{
		$rating = new Tutorial_lab_rating();		
		$query = 'select * from tutorial_lab_rating where rating_id = $rating_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['user_id'], $row['date_posted'], 
				$row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$rating = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>tutorial_lab_rating not found.</p>';
		}

		mysqli_close($db_connection);
		return rating;

	}
	
	
	public function get_ratings_by_user_id($user_id)
	{
		$rating = new Tutorial_lab_rating();		
		$query = 'select * from tutorial_lab_rating where user_id = $user_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['user_id'], $row['date_posted'], 
				$row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$rating = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>tutorial_lab_rating not found.</p>';
		}

		mysqli_close($db_connection);
		return rating;

	}
	
	
	public function get_ratings_by_lab_id($lab_id)
	{
		$rating = new Tutorial_lab_rating();		
		$query = 'select * from tutorial_lab_rating where lab_id = $lab_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['user_id'], $row['date_posted'], 
				$row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$rating = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>tutorial_lab_rating not found.</p>';
		}

		mysqli_close($db_connection);
		return rating;

	}


	public function update_rating($rating)
	{
		$sucess = true;
		// The rating_id should not be changed.
		$query = 'update tutorial_lab_rating set lab_id = $rating->lab_id, user_id = $rating->user_id, date_posted = now(), lab_rating = $rating->lab_rating, comments = $rating->comments
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
			echo '<p>The tutorial_lab_rating could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function save_new_rating($rating)
	{
		$sucess = true;
		// The rating_id is not included, because it is set automatically by the database.
		$query = 'insert into tutorial_lab_rating (lab_id, user_id, date_posted, lab_rating, comments) 
				values($rating->lab_id, $rating->user_id, now(), $rating->lab_rating, $rating->comments)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$rating->rating_id = mysql_insert_id();
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New tutorial_lab_rating could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>