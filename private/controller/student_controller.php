<?php

require_once('../database-access.php');
require_once('../model/Student.php');

class Student_controller {

	public function Student_controller() {}
	//Student ($student_id, $user_id, $first_name, $last_name, $school_type, $school_name)

	public function get_student_by_id($student_id)
	{
		$student = new Student();
		$query = 'select * from student where student_id = $student_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$student->initialize($row['student_id'], $row['user_id'], $row['first_name'], $row['last_name'], 
				$row['school_type'], $row['school_name']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$student = null;
		}

		mysqli_close($db_connection);
		return student;

	}


	public function get_student_by_user_id($user_id)
	{
		$student = new Student();		
		$query = 'select * from student where user_id = $user_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$student->initialize($row['student_id'], $row['user_id'], $row['first_name'], $row['last_name'], 
				$row['school_type'], $row['school_name']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$student = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>Student not found.</p>';
		}

		mysqli_close($db_connection);
		return student;

	}
	

	public function update_student($student)
	{
		$sucess = true;
		
		// The student_id and user_id should not be changed.
		$query = 'update student set first_name = $student->first_name, last_name = $student->last_name, school_type = $student->school_type, school_name = $student->school_name 
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


	public function save_new_student($student)
	{
		$sucess = true;
		
		// The student_id is not included, because it is set automatically by the database.
		$query = 'insert into student (user_id, first_name, last_name, school_type, school_name) 
				values($user_id, $first_name, $last_name, $school_type, $school_name)';
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