<?php



class HomeworkController extends DatabaseController {

	
	public function __construct(){}
	//($homework_id, $assignment_id, $student_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$homework = new Homework();
				$homework->initialize($row['homework_id'], $row['assignment_id'], $row['student_id'], $row['lab_summary'], $row['lab_data'], 
							$row['graphs'], $row['math'], $row['hints'], $row['chat_session']);
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
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$assignment_id = $homework->get_assignment_id();
		$student_id = $homework->get_member_id(); 
		$lab_summary = $homework->get_lab_summary(); 
		$lab_data = $homework->get_lab_data(); 
		$graphs = $homework->get_graphs(); 
		$math = $homework->get_math(); 
		$hints = $homework->get_hints(); 
		$chat_session = $homework->get_chat_session();
		
		$table = $this->getTableName();
		$query = "insert into $table (assignment_id, student_id, lab_summary, lab_data, graphs, math, hints, chat_session) 
		values ('$assignment_id', '$student_id', '$lab_summary', 
					'$lab_data', '$graphs', '$math', '$hints', '$chat_session')";
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
	
	
	// updates the given attribute with the new value in the database and in the homework object
	//($assignment_id, $student_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)
	public function updateAttribute(&$homework, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$homework_id = $homework->get_homework_id();	
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'homework_id':
				return false;
				break;
			case 'student_id':
				$homework->set_student_id($value);	
				$query = "update $table set student_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'assignment_id':
				$homework->set_assignment_id($value);	
				$query = "update $table set assignment_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'lab_summary':
				$homework->set_lab_summary($value);	
				$query = "update $table set lab_summary = '$value' where homework_id = '$homework_id'";
				break;
			case 'lab_data':
				$homework->set_lab_data($value);	
				$query = "update $table set lab_data = '$value' where homework_id = '$homework_id'";
				break;
			case 'graphs':
				$homework->set_graphs($value);	
				$query = "update $table set graphs = '$value' where homework_id = '$homework_id'";
				break;
			case 'math':
				$homework->set_math($value);	
				$query = "update $table set math = '$value' where homework_id = '$homework_id'";
				break;
			case 'hints':
				$homework->set_hints($value);	
				$query = "update $table set hints = '$value' where homework_id = '$homework_id'";
				break;
			case 'chat_session':
				$homework->set_chat_session($value);	
				$query = "update $table set chat_session = '$value' where homework_id = '$homework_id'";
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
		$db_connection = $this->get_db_connection();
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