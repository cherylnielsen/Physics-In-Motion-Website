<?php

require_once('model/Student.php');
require_once('controller/DatabaseController.php');

class StudentController extends DatabaseController{

	public function __construct() {}
	//Student ($student_id, $user_id, $first_name, $last_name, $school_name, $email)

	public function initialize()
	{
		$table = "student";
		$this->setTableName($table);
	}

	private function getData($db_result, &$dataArray)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$student = new Student();
				$student->initialize($row['student_id'], $row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
				// pushes each object onto the end of the array
				$dataArray[] = $student;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	
	
	// The student_id and user_id must not be changed, so they are not updated.
	public function update($student)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$student_id = $student_id->get_student_id();
		$first = $student->get_first_name();
		$last = $student->get_last_name();
		$school = $student->get_school_name();
		$email = $student->get_email();
		
		// The student_id and user_id must not be changed, so they are not updated.
		$query = "update student set first_name = '$first', last_name = '$last', school_name = '$school', email = '$email' 
					where student_id = '$student_id'";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The student could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	// The student_id will be auto-generated, when the new student is added to the database table.
	public function saveNew(&$student)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$user_id = $user_id->get_user_id();
		$first = $student->get_first_name();
		$last = $student->get_last_name();
		$school = $student->get_school_name();
		$email = $student->get_email();
		
		// student_id will be auto-generated		
		$query = "insert into student (user_id, first_name, last_name, school_name, email) 
				values('$user_id', '$first', '$last', '$school', '$email')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the new student_id
			$id = mysqli_insert_id($db_connection);
			$student->set_student_id($id);
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>