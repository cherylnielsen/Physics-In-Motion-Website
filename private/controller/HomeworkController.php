<?php



class HomeworkController extends DatabaseController {

	
	public function __construct(){}
	//($assignment_id, $student_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$homework = new Homework();
				$homework->initialize($row['assignment_id'], $row['student_id'], $row['lab_summary'], $row['lab_data'], 
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
	
	
	// For Homework, the ids are NOT auto-generated.
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
		values ('$assignment_id', '$student_id', '$lab_summary', '$lab_data', '$graphs', '$math', '$hints', '$chat_session')";
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
	
	
	// updates the given attribute with the new value in the database and in the homework object
	//($assignment_id, $student_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)
	public function updateAttribute(&$homework, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$assignment_id = $homework->get_assignment_id();	
		$student_id = $homework->get_member_id();
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'student_id':
			case 'assignment_id':
				return false;
				break;
			case 'lab_summary':
				$homework->set_lab_summary($value);	
				$query = "update $table set lab_summary = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'lab_data':
				$homework->set_lab_data($value);	
				$query = "update $table set lab_data = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'graphs':
				$homework->set_graphs($value);	
				$query = "update $table set graphs = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'math':
				$homework->set_math($value);	
				$query = "update $table set math = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'hints':
				$homework->set_hints($value);	
				$query = "update $table set hints = '$value' 
							where (student_id = '$student_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'chat_session':
				$homework->set_chat_session($value);	
				$query = "update $table set chat_session = '$value' 
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

	
	public function deleteFromDatabase($homework)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$student_id = $homework->get_member_id();
		$assignment_id = $homework->get_assignment_id();
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