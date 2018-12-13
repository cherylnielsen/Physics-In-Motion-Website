<?php


class Student_controller extends DatabaseController{

	public function __construct() {}
	//Student ($student_id, $first_name, $last_name, $school_name, $email)

	

	public function get_by_attribute($attribute_value, $attribute_type, $db_connection)
	{
		$student_array = array();
		$query = "select * from student where $attribute_type = '$attribute_value'";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$student = new Student();
				$student->initialize($row['student_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
				// pushes each object onto the end of the array
				$student_array[] = $student;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $student_array;
	}


	public function get_all($db_connection)
	{
		$student_array = array();
		$query = 'select * from student';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$student = new Student();
				$student->initialize($row['student_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
				// pushes each object onto the end of the array
				$student_array[] = $student;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $student_array;

	}
	
	
	public function update($student, $db_connection)
	{
		$sucess = true;
		
		// The student_id should not be changed. The student_id must match user_id.
		$query = 'update student set first_name = $student->first_name, last_name = $student->last_name, school_name = $student->school_name, email = $student->email  
		where student_id = $student->student_id';
		
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


	public function save_new($student, $db_connection)
	{
		$sucess = true;
		
		// The student_id must match user_id.
		$query = 'insert into student (student_id, first_name, last_name, school_name, email) 
				values($student->student_id, $student->first_name, last_name = $student->last_name, 
				school_name = $student->school_name, email = $student->email)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$student->set_student_id(mysql_insert_id());
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New student could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>