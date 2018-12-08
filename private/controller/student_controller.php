<?php

require_once('../database-access.php');
require_once('../model/student.php');

class student_controller {

	public function student_controller() {}


	public function get_student_by_id($student_id)
	{
		$student = new student();
		$query = 'select * from student where student_id = $student_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$student->initialize($row['student_id'], $row['first_name'], $row['last_name'], $row['school'], $row['user_name'], $row['password'], $row['email']);
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


	public function get_student_by_login($user_name, $password)
	{
		$student = new student();		
		$query = 'select * from student where (user_name = $user_name) AND (password = $password)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$student->initialize($row['student_id'], $row['first_name'], $row['last_name'], $row['school'], $row['user_name'], $row['password'], $row['email']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$student = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>Student not found. Please double check spelling and capitalization, and try again.</p>';
		}

		mysqli_close($db_connection);
		return student;

	}


	public function update_student($student_id, $first_name, $last_name, $school, $user_name, $password, $email)
	{
		$sucess = true;
		$query = 'select * from student where student_id = $student_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
			
			// The student_id is not included, because it should not be changed.
			$query = 'insert into student (first_name, last_name, school, user_name, password, email) 
					values($first_name, $last_name, $school, $user_name, $password, $email)';
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
			
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The student could not be updated, because the student_id was not found.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function save_new_student($first_name, $last_name, $school, $user_name, $password, $email)
	{
		$sucess = true;
		// The student_id is not included, because it is set automatically by the database.
		$query = 'insert into student (first_name, last_name, school, user_name, password, email) 
				values($first_name, $last_name, $school, $user_name, $password, $email)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
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