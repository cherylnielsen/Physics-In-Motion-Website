<?php


class Professor_controller extends DatabaseController{

	public function __construct() {}
	//Professor ($professor_id, $user_id, $first_name, $last_name, $school_name, $email)

	public function get_by_id($id_number, $id_type)
	{
		$professor_array = array();
		$professor_array[] = get_group_by_attribute($id_number, $id_type);
		return $professor_array;
	}
	
	public function get_by_attribute($attribute, $attribute_type)
	{
		$professor_array = array();
		$query = 'select * from professor where $attribute_type = $attribute';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$professor_array[] = new Professor($row['professor_id'], $row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $professor_array;
	}
	
	
	public function get_all()
	{
		$professor_array = array();
		$query = 'select * from professor';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$professor_array[] = new Professor($row['professor_id'], $row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $professor_array;

	}
	
	public function update($professor)
	{
		$sucess = true;
		
		// The professor_id and user_id should not be changed.
		$query = 'update professor set first_name = $professor->first_name, last_name = $professor->last_name, school_name = $professor->school_name, email = $professor->email
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


	public function save_new($professor)
	{
		$sucess = true;
		
		// The professor_id is not included, because it is set automatically by the database.
		$query = 'insert into professor (user_id, first_name, last_name, school_name, email) 
				values($professor->user_id, $professor->first_name, $professor->last_name, $professor->school_name, $professor->email )';
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