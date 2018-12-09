<?php

require_once('../database-access.php');
require_once('../model/student_lab_rating.php');

class student_lab_rating_controller {

	public function student_lab_rating_controller() {}


	public function get_rating_by_professor_and_lab_id($lab_id, $student_id)
	{
		$rating = new student_lab_rating();		
		$query = 'select * from student_lab_rating where (lab_id = $lab_id) AND (student_id = $student_id)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['student_id'], $row['date_posted'], 
				$row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$rating = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>student_lab_rating not found.</p>';
		}

		mysqli_close($db_connection);
		return rating;

	}


	public function get_rating_set_by_lab_id($lab_id)
	{
		$rating = new student_lab_rating();		
		$query = 'select * from student_lab_rating where lab_id = $lab_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$rating->initialize($row['rating_id'], $row['lab_id'], $row['student_id'], $row['date_posted'], 
				$row['lab_rating'], $row['comments']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$rating = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>student_lab_rating not found.</p>';
		}

		mysqli_close($db_connection);
		return rating;

	}


	public function update_rating($rating_id, $lab_id, $student_id, $date_posted, $lab_rating, $comments)
	{
		$sucess = true;
		// The rating_id should not be changed.
		$query = 'update student_lab_rating set lab_id = $lab_id, student_id = $student_id, date_posted = now(), 
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
			echo '<p>The student_lab_rating could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function save_new_rating($lab_id, $student_id, $lab_rating, $comments)
	{
		$sucess = true;
		// The rating_id is not included, because it is set automatically by the database.
		$query = 'insert into student_lab_rating (lab_id, student_id, date_posted, lab_rating, comments) 
				values($lab_id, $student_id, now(), $lab_rating, $comments)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New rating could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>