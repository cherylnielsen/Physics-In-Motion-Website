<?php



class HomeworkController extends DatabaseController {

	
	public function __construct(){}
	//($homework_id, $section_id, $assignment_id, $student_id, $lab_summary, 
	// $lab_data, $graphs, $math, $hints, $chat_session,
	// $date_submitted, $points_earned, $was_graded, $hours)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$homework = new Homework();
				
				$homework->initialize($row['homework_id'], $row['section_id'], $row['assignment_id'], $row['student_id'], 
							$row['lab_summary'], $row['lab_data'], $row['graphs'], $row['math'], $row['hints'], $row['chat_session']
							$row['homework_submission_id'], $row['homework_id'], $row['date_submitted'],
							$row['points_earned'], $row['was_graded'], $row['hours']);
				
				// pushes each object onto the end of the array
				$dataArray[] = $homework;
			}		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}
	
	
	// For homework, the ids are auto-generated.
	public function saveNew(&$homework)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$section_id = $homework->get_section_id();
		$assignment_id = $homework->get_assignment_id();
		$student_id = $homework->get_member_id(); 
		$lab_summary = $homework->get_lab_summary(); 
		$lab_data = $homework->get_lab_data(); 
		$graphs = $homework->get_graphs(); 
		$math = $homework->get_math(); 
		$hints = $homework->get_hints(); 
		$chat_session = $homework->get_chat_session();
		$date_submitted = $submission->get_date_submitted();
		$points_earned = $submission->get_points_earned();
		$was_graded = $submission->get_was_graded();
		$hours = $submission->get_hours();
		
		$table = $this->getTableName();

		$query = "insert into $table (section_id, assignment_id, student_id, lab_summary, lab_data, 
						graphs, math, hints, chat_session, date_submitted, points_earned, was_graded, hours) 
				values ('$section_id', '$assignment_id', '$student_id', '$lab_summary', '$lab_data', 
						'$graphs', '$math', '$hints', '$chat_session', '$date_submitted', 
						'$points_earned', '$was_graded', '$hours')";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated homework_id
			$homework_id = mysqli_insert_id($db_connection);
			$member->set_homework_id($homework_id);
		}
		
		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	// updates the given key with the new value in the database 
	//($assignment_id, $student_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)
	public function updateAttribute($homework, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$homework_id = $homework->get_homework_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'homework_id':
				return false;
				break;
			case 'section_id':
				$value = $homework->get_section_id();	
				$query = "update $table set section_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'assignment_id':
				$value = $homework->get_assignment_id();	
				$query = "update $table set assignment_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'student_id':
				$value = $homework->get_student_id();	
				$query = "update $table set student_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'lab_summary':
				$value = $homework->get_lab_summary();	
				$query = "update $table set lab_summary = '$value' where homework_id = '$homework_id'";
				break;
			case 'lab_data':
				$value = $homework->get_lab_data();	
				$query = "update $table set lab_data = '$value' where homework_id = '$homework_id'";
				break;
			case 'graphs':
				$value = $homework->get_graphs();	
				$query = "update $table set graphs = '$value' where homework_id = '$homework_id'";
				break;
			case 'math':
				$value = $homework->get_math();	
				$query = "update $table set math = '$value' where homework_id = '$homework_id'";
				break;
			case 'hints':
				$value = $homework->get_hints();	
				$query = "update $table set hints = '$value' where homework_id = '$homework_id'";
				break;
			case 'chat_session':
				$value = $homework->get_chat_session();	
				$query = "update $table set chat_session = '$value' where homework_id = '$homework_id'";
				break;
			case 'date_submitted':
				$value = $homework->get_date_submitted();	
				$query = "update $table set date_submitted = '$value' where homework_id = '$homework_id'";
				break;
			case 'points_earned':
				$value = $homework->get_points_earned();	
				$query = "update $table set points_earned = '$value' where homework_id = '$homework_id'";
				break;
			case 'was_graded':
				$value = $homework->get_was_graded();	
				$query = "update $table set was_graded = '$value' where homework_id = '$homework_id'";
				break;
			case 'hours':
				$value = $homework->get_hours();	
				$query = "update $table set hours = '$value' where homework_id = '$homework_id'";
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

	
	public function deleteFromDatabase($homework)
	{
		$db_connection = get_db_connection();
		$success = true;
		$homework_id = $homework->get_homework_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where homework_id = '$homework_id'";
		
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