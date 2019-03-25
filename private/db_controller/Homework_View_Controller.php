<?php

class Homework_View_Controller extends DatabaseController {

	public function __construct(){}
	// ($homework_id, $section_id, $assignment_id, $assignment_name,
	// $tutorial_lab_id, $student_id, $lab_summary, 
	// $lab_data, $graphs, $math, $hints, $chat_session,
	// $date_submitted, $points_possible, $points_earned, $was_graded, $hours)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$homework = new Homework_View();
				
				$homework->initializeView($row['homework_id'], $row['section_id'], 
						$row['assignment_id'], $row['assignment_name'], $row['tutorial_lab_id'], 
						$row['student_id'], $row['lab_summary'], $row['lab_data'], 
						$row['graphs'], $row['math'], $row['hints'], $row['chat_session'], 
						$row['date_submitted'], $row['filepath'], 
						$row['student_first_name'], $row['student_last_name'], 
						$row['school_name'], $row['points_possible'], 
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
	
	
	public function getOneHomeworkView($section_id, $assignment_id, $student_id)
	{
		$table = $this->getTableName();
		$db_connection = get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table where (section_id = '$section_id') 
										AND (assignment_id = '$assignment_id')
										AND (student_id = '$student_id')";
		
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);					
		mysqli_close($db_connection);		
		$dataObject = null;
		
		if(count($dataArray) === 1)
		{
			$dataObject = $dataArray[0];
		}
		
		return $dataObject;
	}
	
	
	// updates the given key with the new value in the database 
	//($assignment_id, $student_id, $lab_summary, $lab_data, $graphs, $math, $hints, $chat_session)
	public function updateAttribute($homework_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$homework_id = $homework_view->get_homework_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'homework_id':
				return false;
				break;
			case 'section_id':
				$value = $homework_view->get_section_id();	
				$query = "update $table set section_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'assignment_id':
				$value = $homework_view->get_assignment_id();	
				$query = "update $table set assignment_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'assignment_name':
				$value = $homework_view->get_assignment_name();	
				$query = "update $table set assignment_name = '$value' where homework_id = '$homework_id'";
				break;
			case 'tutorial_lab_id':
				$value = $homework_view->get_tutorial_lab_id();	
				$query = "update $table set tutorial_lab_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'student_id':
				$value = $homework_view->get_student_id();	
				$query = "update $table set student_id = '$value' where homework_id = '$homework_id'";
				break;
			case 'lab_summary':
				$value = $homework_view->get_lab_summary();	
				$query = "update $table set lab_summary = '$value' where homework_id = '$homework_id'";
				break;
			case 'lab_data':
				$value = $homework_view->get_lab_data();	
				$query = "update $table set lab_data = '$value' where homework_id = '$homework_id'";
				break;
			case 'graphs':
				$value = $homework_view->get_graphs();	
				$query = "update $table set graphs = '$value' where homework_id = '$homework_id'";
				break;
			case 'math':
				$value = $homework_view->get_math();	
				$query = "update $table set math = '$value' where homework_id = '$homework_id'";
				break;
			case 'hints':
				$value = $homework_view->get_hints();	
				$query = "update $table set hints = '$value' where homework_id = '$homework_id'";
				break;
			case 'chat_session':
				$value = $homework_view->get_chat_session();	
				$query = "update $table set chat_session = '$value' where homework_id = '$homework_id'";
				break;
			case 'date_submitted':
				$value = $homework_view->get_date_submitted();	
				$query = "update $table set date_submitted = '$value' where homework_id = '$homework_id'";
				break;
			case 'filepath':
				$value = $homework_view->get_filepath();	
				$query = "update $table set filepath = '$value' where homework_id = '$homework_id'";
				break;
			case 'points_possible':
				$value = $homework_view->get_points_possible();	
				$query = "update $table set points_possible = '$value' where homework_id = '$homework_id'";
				break;
			case 'points_earned':
				$value = $homework_view->get_points_earned();	
				$query = "update $table set points_earned = '$value' where homework_id = '$homework_id'";
				break;
			case 'was_graded':
				$value = $homework_view->get_was_graded();	
				$query = "update $table set was_graded = '$value' where homework_id = '$homework_id'";
				break;
			case 'hours':
				$value = $homework_view->get_hours();	
				$query = "update $table set hours = '$value' where homework_id = '$homework_id'";
				break;
			case 'student_first_name':
				$value = $homework_view->get_student_first_name();	
				$query = "update $table set student_first_name = '$value' where homework_id = '$homework_id'";
				break;
			case 'student_last_name':
				$value = $homework_view->get_student_last_name();	
				$query = "update $table set student_last_name = '$value' where homework_id = '$homework_id'";
				break;
			case 'school_name':
				$value = $homework_view->get_school_name();	
				$query = "update $table set school_name = '$value' where homework_id = '$homework_id'";
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

	
	// database view objects do not do full updates
	// due to multiple tables being involved
	public function updateAll($homework_view)
	{
		return false;
	}
	
	
	// database view objects do new database entries
	// due to multiple tables being involved
	public function saveNew(&$homework_view)
	{
		return false;
	}


	// database view objects do not delete objects from the database
	// due to multiple tables being involved
	public function deleteFromDatabase($homework_view)
	{
		return false;
	}
	
	
}

?>