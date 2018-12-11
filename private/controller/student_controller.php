<?php


class Student_controller extends DatabaseController{

	public function __construct() {}
	//Student ($student_id, $user_id, $first_name, $last_name, $school_name, $email)

	public function get_by_id($id_number, $id_type)
	{
		$student_array = array();
		$student_array[] = get_group_by_attribute($id_number, $id_type);
		return $student_array;
	}


	public function get_by_attribute($attribute, $attribute_type)
	{
		$student_array = array();
		$query = 'select * from student where $attribute_type = $attribute';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$student_array[] = new Student($row['student_id'], $row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
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


	public function get_all()
	{
		$student_array = array();
		$query = 'select * from student';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$student_array[] = new Student($row['student_id'], $row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
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
	
	
	public function update($student)
	{
		$sucess = true;
		
		// The student_id and user_id should not be changed.
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


	public function save_new($student)
	{
		$sucess = true;
		
		// The student_id is not included, because it is set automatically by the database.
		$query = 'insert into student (user_id, first_name, last_name, school_name, email) 
				values($student->user_id, $student->first_name, last_name = $student->last_name, 
				school_name = $student->school_name, email = $student->email)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$student->student_id = mysql_insert_id();
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