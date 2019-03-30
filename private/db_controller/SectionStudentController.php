<?php



class SectionStudentController extends DatabaseController {

	
	public function __construct() {}
	//($section_id, $student_id, $dropped_section)
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_student = new Section_Student();
				$section_student->initialize($row['section_id'], $row['student_id'], $row['dropped_section']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_student;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// The id for section_student is NOT auto-generated.
	public function saveNew(&$section_student)
	{
		$sucess = true;
		$db_connection = get_db_connection();
		$section_id = $section_student->get_section_id();
		$student_id = $section_student->get_student_id();
		$dropped_section = $section_student->get_dropped_section();
		$table = $this->getTableName();
		
		$query = "insert into $table (section_id, student_id, dropped_section) 
				values('$section_id', '$student_id', '$dropped_section')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
	
		mysqli_close($db_connection);
		return $sucess;
	}
	
	
	// updates the given key with the new value in the database
	//($section_id, $student_id, $dropped_section)
	public function updateAttribute($section_student, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section_student->get_section_id();	
		$student_id = $section_student->get_student_id();
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'section_id':
			case 'student_id':
				return false;
				break;
			case 'dropped_section':
				$value = $section_student->get_dropped_section();	
				$query = "update $table set dropped_section = '$value' where (section_id = '$section_id') AND (student_id = '$student_id')";
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

	
	public function updateAll($security_question)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$section_id = $section_student->get_section_id();	
		$student_id = $section_student->get_student_id();
		
		// data to be updated			
		$dropped_section = $student->get_dropped_section();
					
		$query = "UPDATE $table 
					SET dropped_section = '$dropped_section'
					WHERE (section_id = '$section_id') AND (student_id = '$student_id')";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
	}
	
	
	public function deleteFromDatabase($section_student)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section_student->get_section_id();
		$student_id = $section_student->get_student_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where (section_id = $section_id) AND (student_id = $student_id)";
		$result = mysqli_query($db_connection, $query);
		
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