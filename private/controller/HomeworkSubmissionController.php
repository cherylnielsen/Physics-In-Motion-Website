<?php



class HomeworkSubmissionController extends DatabaseController {

	
	public function __construct() {}
	//($assignment_id, $student_id, $date_submitted, $points_earned, $was_graded, $total_time)
	
	public function initialize()
	{
		$table = "submission";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$submission = new Homwork_Submission();
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
	}
	

	// The id for homwork_submission is NOT auto-generated.
	public function saveNew(&$submission)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$assignment_id = $submission->get_assignment_id();
		$student_id = $submission->get_student_id();
		$date_submitted = $submission->get_date_submitted();
		$points_earned = $submission->get_points_earned();
		$was_graded = $submission->get_was_graded();
		$total_time = $submission->get_total_time();
		
		$query = "insert into submission (assignment_id, student_id, date_submitted, points_earned, was_graded, total_time) 
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
	

	// The ids must not be changed, so they are not updated.
	public function update($submission)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$assignment_id = $submission->get_assignment_id();
		$student_id = $submission->get_student_id();
		$date_submitted = $submission->get_date_submitted();
		$points_earned = $submission->get_points_earned();
		$was_graded = $submission->get_was_graded();
		$total_time = $submission->get_total_time();
		
		// The ids must not be changed, so they are not updated.
		$query = "update submission set date_submitted = '$date_submitted', points_earned = '$points_earned', 
					was_graded = '$was_graded', total_time = '$total_time' 
					where (assignment_id = '$assignment_id') AND (student_id = '$student_id')";
				
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>