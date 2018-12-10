<?php

require_once('../database-access.php');
require_once('../model/Professor.php');

class Professor_controller {

	public function Professor_controller() {}
	//Student ($professor_id, $user_id, $first_name, $last_name, $school_type, $school_name)

	public function get_professor_by_id($professor_id)
	{
		$professor = new Professor();
		$query = 'select * from professor where professor_id = $professor_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$professor->initialize($row['professor_id'], $row['user_id'], $row['first_name'], $row['last_name'], 
				$row['school_type'], $row['school_name']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$professor = null;
		}

		mysqli_close($db_connection);
		return professor;

	}


	public function get_professor_by_user_id($user_id)
	{
		$professor = new Professor();		
		$query = 'select * from professor where user_id = $user_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$professor->initialize($row['professor_id'], $row['user_id'], $row['first_name'], $row['last_name'], 
				$row['school_type'], $row['school_name']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$professor = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>Student not found.</p>';
		}

		mysqli_close($db_connection);
		return professor;

	}
	

	public function update_professor($professor)
	{
		$sucess = true;
		
		// The professor_id and user_id should not be changed.
		$query = 'update professor set first_name = $professor->first_name, last_name = $professor->last_name, school_type = $professor->school_type, school_name = $professor->school_name 
		where professor_id = $professor->professor_id';
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The professor could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function save_new_professor($professor)
	{
		$sucess = true;
		
		// The professor_id is not included, because it is set automatically by the database.
		$query = 'insert into professor (user_id, first_name, last_name, school_type, school_name) 
				values($user_id, $first_name, $last_name, $school_type, $school_name)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$professor->professor_id = mysql_insert_id();
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New professor could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>