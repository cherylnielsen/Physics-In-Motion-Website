<?php



class ProfessorController extends DatabaseController{


	public function __construct() {}
	//Professor ($user_id, $first_name, $last_name, $school_name, $email)

	public function initialize()
	{
		$this->tableName = "professor";
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$professor = new Professor();
				$professor->initialize($row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
				// pushes each object onto the end of the array
				$dataArray[] = $professor;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
	}
	
	
	// updates the given attribute with the new value in the database and in the professor object
	public function update_attribute(&$professor, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $professor->get_user_id();	
		
		switch ($attribute)
		{
			case 'user_id':
				return false;
				break;
			case 'first_name':
				$professor->set_first_name($value);	
				$query = "update professor set first_name = '$value' where user_id = '$user_id'";
				break;
			case 'last_name':
				$professor->set_last_name($value);	
				$query = "update professor set last_name = '$value' where user_id = '$user_id'";
				break;
			case 'school_name':
				$professor->set_school_name($value);	
				$query = "update professor set school_name = '$value' where user_id = '$user_id'";
				break;
			case 'email':
				$professor->set_email($value);	
				$query = "update professor set email = '$value' where user_id = '$user_id'";
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


	
	public function saveNew(&$professor)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$user_id = $professor->get_user_id();
		$first = $professor->get_first_name();
		$last = $professor->get_last_name();
		$school = $professor->get_school_name();
		$email = $professor->get_email();
		
		
		$query = "insert into professor (user_id, first_name, last_name, school_name, email) 
				values('$user_id', '$first', '$last', '$school', '$email')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


	public function delete_from_database($professor)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $professor->get_user_id();
		
		$query = "delete from professor where user_id = $user_id";
		
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