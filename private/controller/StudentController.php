<?php


class StudentController extends DatabaseController
{
	
	public function __construct() {}
	//Student ($user_id, $first_name, $last_name, $school_name, $email)

	public function initialize()
	{
		$this->tableName = "student";
	}


	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$student = new Student();
				$student->initialize($row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
				// pushes each object onto the end of the array
				$dataArray[] = $student;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	// updates the given attribute with the new value in the database and in the student object
	public function update_attribute(&$student, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $student->get_user_id();	
		
		switch ($attribute)
		{
			case 'user_id':
				return false;
				break;
			case 'first_name':
				$student->set_first_name($value);	
				$query = "update student set first_name = '$value' where user_id = '$user_id'";
				break;
			case 'last_name':
				$student->set_last_name($value);	
				$query = "update student set last_name = '$value' where user_id = '$user_id'";
				break;
			case 'school_name':
				$student->set_school_name($value);	
				$query = "update student set school_name = '$value' where user_id = '$user_id'";
				break;
			case 'email':
				$student->set_email($value);	
				$query = "update student set email = '$value' where user_id = '$user_id'";
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
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $student->get_user_id();
		$first = $student->get_first_name();
		$last = $student->get_last_name();
		$school = $student->get_school_name();
		$email = $student->get_email();
		
	
		$query = "insert into student (user_id, first_name, last_name, school_name, email) 
				values('$user_id', '$first', '$last', '$school', '$email')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
		
	}


	public function delete_from_database($student)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $student->get_user_id();
		
		$query = "delete from student where user_id = $user_id";
		
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