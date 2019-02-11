<?php



class HomeworkSubmissionController extends DatabaseController {

	
	public function __construct(){}
	//($assignment_id, $student_id, $date_submitted, $points_earned, $was_graded, $total_time)
	

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$submission = new Homework_Submission();
				$submission->initialize($row['assignment_id'], $row['student_id'], $row['date_submitted'],
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
	

	// The id for homwork_submission is NOT auto-generated.
	public function saveNew(&$submission)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$assignment_id = $submission->get_assignment_id();
		$student_id = $submission->get_member_id();
		$date_submitted = $submission->get_date_submitted();
		$points_earned = $submission->get_points_earned();
		$was_graded = $submission->get_was_graded();
		$total_time = $submission->get_total_time();
		
		$table = $this->getTableName();
		$query = "insert into $table (assignment_id, student_id, date_submitted, points_earned, was_graded, total_time) 
				values('$assignment_id', '$student_id', '$date_submitted', '$points_earned', '$was_graded', '$total_time')";
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
	//($assignment_id, $student_id, $date_submitted, $points_earned, $was_graded, $total_time)
	public function updateAttribute(&$homework_submission, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$student_id = $homework_submission->get_member_id();	
		$assignment_id = $homework_submission->get_assignment_id();	
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'student_id':
			case 'assignment_id':
				return false;
				break;
			case 'date_submitted':
				$homework_submission->set_date_submitted($value);	
				$query = "update $table set date_submitted = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'points_earned':
				$homework_submission->set_points_earned($value);	
				$query = "update $table set points_earned = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'was_graded':
				$homework_submission->set_was_graded($value);	
				$query = "update $table set was_graded = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'total_time':
				$homework_submission->set_total_time($value);	
				$query = "update $table set total_time = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
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
		$student_id = $homework_submission->get_member_id();
		$assignment_id = $homework_submission->get_assignment_id();
		
		$table = $this->getTableName();
		$query = "delete from $table where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
		
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