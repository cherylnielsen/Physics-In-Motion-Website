<?php

require_once('model/Homework.php');
require_once('controller/DatabaseController.php');

class HomeworkController extends DatabaseController {

	public function __construct() {}
	//($assignment_id, $student_id, $lab_summary, $data, $graphs, $math, $hints, $chat_session)

	public function initialize()
	{
		$table = "homework";
		$this->setTableName($table);
	}

	private function getData($db_result, &$dataArray)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$homework = new Homework();
				$homework->initialize($row['assignment_id'], $row['student_id'], $row['lab_summary'], $row['data'], 
							$row['graphs'], $row['math'], $row['hints'], $row['chat_session']);
				// pushes each object onto the end of the array
				$dataArray[] = $homework;
			}		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	
	
	// The ids must not be changed, so they are not updated.
	public function update($homework)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$assignment_id = $homework->get_assignment_id(); 
		$student_id = $homework->get_student_id(); 
		$lab_summary = $homework->get_lab_summary(); 
		$data = $homework->get_data(); 
		$graphs = $homework->get_graphs(); 
		$math = $homework->get_math(); 
		$hints = $homework->get_hints(); 
		$chat_session = $homework->get_chat_session();
		
		// The ids must not be changed, so they are not updated.
		$query = "update homework set lab_summary = '$lab_summary', data = '$data', graphs = '$graphs', 
				math = '$math', hints = '$hints', chat_session = '$chat_session' 
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
	
	
	// For Homework, the ids are NOT auto-generated.
	public function saveNew(&$homework)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$assignment_id = $homework->get_assignment_id(); 
		$student_id = $homework->get_student_id(); 
		$lab_summary = $homework->get_lab_summary(); 
		$data = $homework->get_data(); 
		$graphs = $homework->get_graphs(); 
		$math = $homework->get_math(); 
		$hints = $homework->get_hints(); 
		$chat_session = $homework->get_chat_session();
		
		
		$query = "insert into homework (assignment_id, student_id, lab_summary, data, graphs, math, hints, chat_session) 
		values ('$assignment_id', '$student_id', '$lab_summary', '$data', '$graphs', '$math', '$hints', '$chat_session')";
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
	

}

?>