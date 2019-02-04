<?php



class HomeworkSubmissionController extends DatabaseController {

	
	public function __construct() {}
	//($assignment_id, $user_id, $date_submitted, $points_earned, $is_graded, $total_time)
	
	public function initialize()
	{
		$this->tableName = "homework_submission";
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$submission = new Homwork_Submission();
				$submission->initialize($row['assignment_id'], $row['user_id'], $row['date_submitted'],
							$row['points_earned'], $row['is_graded'], $row['total_time']);
				// pushes each object onto the end of the array
				$dataArray[] = $submission;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	

	// The id for homwork_submission is NOT auto-generated.
	public function saveNew(&$submission)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$assignment_id = $submission->get_assignment_id();
		$user_id = $submission->get_user_id();
		$date_submitted = $submission->get_date_submitted();
		$points_earned = $submission->get_points_earned();
		$is_graded = $submission->get_is_graded();
		$total_time = $submission->get_total_time();
		
		$query = "insert into homework_submission (assignment_id, user_id, date_submitted, points_earned, is_graded, total_time) 
				values('$assignment_id', '$user_id', '$date_submitted', '$points_earned', '$is_graded', '$total_time')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;
		
	}
	

	// updates the given attribute with the new value in the database and in the homework_submission object
	//($assignment_id, $user_id, $date_submitted, $points_earned, $is_graded, $total_time)
	public function update_attribute(&$homework_submission, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $homework_submission->get_user_id();	
		$assignment_id = $homework_submission->get_assignment_id();	
		
		switch ($attribute)
		{
			case 'user_id':
			case 'assignment_id':
				return false;
				break;
			case 'date_submitted':
				$homework_submission->set_date_submitted($value);	
				$query = "update homework_submission set date_submitted = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'points_earned':
				$homework_submission->set_points_earned($value);	
				$query = "update homework_submission set points_earned = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'is_graded':
				$homework_submission->set_is_graded($value);	
				$query = "update homework_submission set is_graded = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'total_time':
				$homework_submission->set_total_time($value);	
				$query = "update homework_submission set total_time = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
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

	
	public function delete_from_database($homework_submission)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $homework_submission->get_user_id();
		$assignment_id = $homework_submission->get_assignment_id();
		
		$query = "delete from homework_submission where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
		
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