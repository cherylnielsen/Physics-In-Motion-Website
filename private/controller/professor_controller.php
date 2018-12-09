<?php

require_once('../database-access.php');
require_once('../model/professor.php');

class professor_controller {

	public function professor_controller() {}


	public function get_professor_by_id($professor_id)
	{
		$professor = new professor();
		$query = 'select * from professor where professor_id = $professor_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$professor->initialize($row['professor_id'], $row['first_name'], $row['last_name'], $row['school'], $row['user_name'], $row['user_password'], $row['email'], $row['date_joined']);
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


	public function get_professor_by_login($user_name, $password)
	{
		$professor = new professor();		
		$query = 'select * from professor where (user_name = $user_name) AND (user_password = $user_password)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$professor->initialize($row['professor_id'], $row['first_name'], $row['last_name'], $row['school'], $row['user_name'], $row['user_password'], $row['email'], , $row['date_joined']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$professor = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>Professor not found. Please double check spelling and capitalization, and try again.</p>';
		}

		mysqli_close($db_connection);
		return professor;

	}


	public function update_professor($professor_id, $first_name, $last_name, $school, $user_name, $user_password, $email)
	{
		$sucess = true;
		// The professor_id and date_joined should not be changed.
		$query = 'update professor set first_name = $first_name, last_name = $last_name, school = $school, 
					user_name = $user_name, user_password = $user_password, email = $email
					where professor_id = $professor_id';
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


	public function save_new_professor($first_name, $last_name, $school, $user_name, $user_password, $email)
	{
		$sucess = true;
		// The professor_id is not included, because it is set automatically by the database.
		$query = 'insert into professor (first_name, last_name, school, user_name, user_password, email) 
				values($first_name, $last_name, $school, $user_name, $user_password, $email, now())';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
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