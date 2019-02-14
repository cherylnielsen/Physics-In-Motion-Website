<?php



class HomeworkSubmissionController extends DatabaseController {

	
	public function __construct(){}
	//($submission_id, $homework_id, $date_submitted, $points_earned, $was_graded, $total_time)
	

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$submission = new Homework_Submission();
				$submission->initialize($row['submission_id'], $row['homework_id'], $row['date_submitted'],
							$row['points_earned'], $row['was_graded'], $row['total_time']);
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
		$db_connection = $this->get_db_connection();
		$homework_id = $submission->get_member_id();
		$date_submitted = $submission->get_date_submitted();
		$points_earned = $submission->get_points_earned();
		$was_graded = $submission->get_was_graded();
		$total_time = $submission->get_total_time();
		
		$table = $this->getTableName();
		$query = "insert into $table (homework_id, date_submitted, points_earned, was_graded, total_time) 
				values('$homework_id', '$date_submitted', '$points_earned', '$was_graded', '$total_time')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated homework_id
			$submission_id = mysqli_insert_id($db_connection);
			$member->set_submission_id($submission_id);
		}
		
		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;
		
	}
	

	// updates the given attribute with the new value in the database and in the homework_submission object
	//($submission_id, $homework_id, $date_submitted, $points_earned, $was_graded, $total_time)
	public function updateAttribute(&$homework_submission, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'submission_id':
				return false;
				break;
			case 'homework_id':
				$homework_submission->set_homework_id($value);	
				$query = "update $table set homework_id = '$value' where submission_id = '$submission_id'";
				break;
			case 'date_submitted':
				$homework_submission->set_date_submitted($value);	
				$query = "update $table set date_submitted = '$value' where submission_id = '$submission_id'";
				break;
			case 'points_earned':
				$homework_submission->set_points_earned($value);	
				$query = "update $table set points_earned = '$value' where submission_id = '$submission_id'";
				break;
			case 'was_graded':
				$homework_submission->set_was_graded($value);	
				$query = "update $table set was_graded = '$value' where submission_id = '$submission_id'";
				break;
			case 'total_time':
				$homework_submission->set_total_time($value);	
				$query = "update $table set total_time = '$value' where submission_id = '$submission_id'";
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
		$db_connection = $this->get_db_connection();
		$success = true;
		$submission_id = $homework_submission->get_submission_id();
		
		$table = $this->getTableName();
		$query = "delete from $table where submission_id = '$submission_id'";
		
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