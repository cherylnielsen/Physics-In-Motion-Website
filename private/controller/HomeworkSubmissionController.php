<?php



class HomeworkSubmissionController extends DatabaseController {

	
	public function __construct(){}
	//($homework_submission_id, $homework_id, $date_submitted, $points_earned, $was_graded, $hours)
	

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$submission = new Homework_Submission();
				$submission->initialize($row['homework_submission_id'], $row['homework_id'], $row['date_submitted'],
							$row['points_earned'], $row['was_graded'], $row['hours']);
				// pushes each object onto the end of the array
				$dataArray[] = $submission;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}
	

	// The id for homwork_submission is auto-generated.
	public function saveNew(&$submission)
	{
		$sucess = true;
		$db_connection = get_db_connection();
		$homework_id = $submission->get_member_id();
		$date_submitted = $submission->get_date_submitted();
		$points_earned = $submission->get_points_earned();
		$was_graded = $submission->get_was_graded();
		$hours = $submission->get_hours();
		
		$table = $this->getTableName();
		$query = "insert into $table (homework_id, date_submitted, points_earned, was_graded, hours) 
				values('$homework_id', '$date_submitted', '$points_earned', '$was_graded', '$hours')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated homework_id
			$homework_submission_id = mysqli_insert_id($db_connection);
			$member->set_homework_submission_id($homework_submission_id);
		}
		
		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;
		
	}
	

	// updates the given key with the new value in the database
	//($homework_submission_id, $homework_id, $date_submitted, $points_earned, $was_graded, $hours)
	public function updateAttribute($homework_submission, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'homework_submission_id':
				return false;
				break;
			case 'homework_id':
				$value = $homework_submission->get_homework_id();	
				$query = "update $table set homework_id = '$value' where homework_submission_id = '$homework_submission_id'";
				break;
			case 'date_submitted':
				$value = $homework_submission->get_date_submitted();	
				$query = "update $table set date_submitted = '$value' where homework_submission_id = '$homework_submission_id'";
				break;
			case 'points_earned':
				$value = $homework_submission->get_points_earned();	
				$query = "update $table set points_earned = '$value' where homework_submission_id = '$homework_submission_id'";
				break;
			case 'was_graded':
				$value = $homework_submission->get_was_graded();	
				$query = "update $table set was_graded = '$value' where homework_submission_id = '$homework_submission_id'";
				break;
			case 'hours':
				$value = $homework_submission->get_hours();	
				$query = "update $table set hours = '$value' where homework_submission_id = '$homework_submission_id'";
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

	
	public function deleteFromDatabase($homework_submission)
	{
		$db_connection = get_db_connection();
		$success = true;
		$homework_submission_id = $homework_submission->get_homework_submission_id();
		
		$table = $this->getTableName();
		$query = "delete from $table where homework_submission_id = '$homework_submission_id'";
		
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