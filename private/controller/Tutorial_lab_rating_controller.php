<?php


class Tutorial_lab_rating_controller extends DatabaseController {

	public function __construct() {}
	//($rating_id, $lab_id, $user_id, $date_posted, $lab_rating, $comments)
	
	public function get_by_id($id_number, $id_type)
	{
		$rating_array = array();
		$rating_array[] = get_by_attribute($id_number, $id_type);
		return $rating_array;
	}
	
	
	public function get_by_attribute($attribute, $attribute_type)
	{
		$rating_array = array();
		$query = 'select * from tutorial_lab_rating where $attribute_type = $attribute';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$rating_array[] = new Tutorial_lab_rating($row['rating_id'], $row['lab_id'], $row['user_id'], $row['date_posted'], $row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $rating_array;
	}
	
	
	public function get_all()
	{
		$rating_array = array();
		$query = 'select * from quote';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$rating_array[] = new Tutorial_lab_rating($row['rating_id'], $row['lab_id'], $row['user_id'], $row['date_posted'], $row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $rating_array;

	}
	
	
	public function update($rating)
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


	public function save_new($rating)
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