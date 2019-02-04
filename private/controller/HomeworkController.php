<?php



class HomeworkController extends DatabaseController {

	
	public function __construct() {}
	//($assignment_id, $user_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)

	public function initialize()
	{
		$this->tableName = "homework";
	}

	protected function getData($db_result, &$lab_dataArray, $db_connection)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$homework = new Homework();
				$homework->initialize($row['assignment_id'], $row['user_id'], $row['lab_summary'], $row['lab_data'], 
							$row['graphs'], $row['math'], $row['hints'], $row['chat_session']);
				// pushes each object onto the end of the array
				$lab_dataArray[] = $homework;
			}		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	
	
	// For Homework, the ids are NOT auto-generated.
	public function saveNew(&$homework)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$assignment_id = $homework->get_assignment_id(); 
		$user_id = $homework->get_user_id(); 
		$lab_summary = $homework->get_lab_summary(); 
		$lab_data = $homework->get_lab_data(); 
		$graphs = $homework->get_graphs(); 
		$math = $homework->get_math(); 
		$hints = $homework->get_hints(); 
		$chat_session = $homework->get_chat_session();
		
		
		$query = "insert into homework (assignment_id, user_id, lab_summary, lab_data, graphs, math, hints, chat_session) 
		values ('$assignment_id', '$user_id', '$lab_summary', '$lab_data', '$graphs', '$math', '$hints', '$chat_session')";
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
	//($assignment_id, $user_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)
	public function update_attribute(&$homework, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$assignment_id = $homework->get_assignment_id();	
		$user_id = $homework->get_user_id();
		
		switch ($attribute)
		{
			case 'user_id':
			case 'assignment_id':
				return false;
				break;
			case 'lab_summary':
				$homework->set_lab_summary($value);	
				$query = "update homework set lab_summary = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'lab_data':
				$homework->set_lab_data($value);	
				$query = "update homework set lab_data = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'graphs':
				$homework->set_graphs($value);	
				$query = "update homework set graphs = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'math':
				$homework->set_math($value);	
				$query = "update homework set math = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'hints':
				$homework->set_hints($value);	
				$query = "update homework set hints = '$value' 
							where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
				break;
			case 'chat_session':
				$homework->set_chat_session($value);	
				$query = "update homework set chat_session = '$value' 
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

	
	public function delete_from_database($homework)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $homework->get_user_id();
		$assignment_id = $homework->get_assignment_id();
		
		$query = "delete from homework where (user_id = '$user_id') AND (assignment_id = '$assignment_id')";
		
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