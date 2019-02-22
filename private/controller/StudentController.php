<?php


class StudentController extends DatabaseController
{
	
	public function __construct() {}
	//Student ($student_id, $school_name)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$student = new Student();
				$student->set_student_id($row['student_id']);
				$student->set_school_name($row['school_name']);
				// pushes each object onto the end of the array
				$dataArray[] = $student;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// updates the given key with the new value in the database
	public function updateAttribute($student, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$student_id = $student->get_student_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'student_id':
				return false;
				break;
			case 'school_name':
				$value = $student->get_school_name();
				$query = "update $table set school_name = '$value' where student_id = '$student_id'";
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


	public function saveNew(&$student)
	{
		$db_connection = get_db_connection();
		$success = true;
		$student_id = $student->get_student_id();
		$school = $student->get_school_name();
		$table = $this->getTableName();
	
		$query = "insert into $table (student_id, school_name) values('$student_id', '$school')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
		
	}


	public function deleteFromDatabase($student)
	{
		$db_connection = get_db_connection();
		$success = true;
		$student_id = $student->get_student_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where student_id = $student_id";
		
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