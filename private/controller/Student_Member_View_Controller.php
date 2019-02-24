<?php


class Student_Member_View_Controller extends DatabaseController
{
	
	public function __construct() {}
	// $student_id, $student_name, $email, $school_name


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$student = new Student_Member_View();
				$student->set_student_id($row['student_id']);
				$student->set_student_name($row['student_name']);
				$student->set_email($row['email']);
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
			case 'student_name':
				$value = $student->get_student_name();
				$query = "update $table set student_name = '$value' where student_id = '$student_id'";
				break;
			case 'school_name':
				$value = $student->get_school_name();
				$query = "update $table set school_name = '$value' where student_id = '$student_id'";
				break;
			case 'email':
				$value = $student->get_email();
				$query = "update $table set email = '$value' where student_id = '$student_id'";
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
		$student_name = $student->get_student_name();
		$email = $student->get_email();
		$school_name = $student->get_school_name();
		$table = $this->getTableName();
	
		$query = "insert into $table (student_id, student_name, email, school_name) 
					values('$student_id', '$student_name', '$email', '$school_name')";
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