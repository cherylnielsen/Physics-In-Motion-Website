<?php



class ProfessorController extends DatabaseController{

	public function __construct() {}
	//Professor ($professor_id, $user_id, $first_name, $last_name, $school_name, $email)

	public function initialize()
	{
		$table = "professor";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$professor = new Professor();
				$professor->initialize($row['professor_id'], $row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
				// pushes each object onto the end of the array
				$dataArray[] = $professor;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
	}
	
	
	// The ids must not be changed, so they are not updated.
	public function update($professor)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$professor_id = $professor->get_professor_id();
		$first = $professor->get_first_name();
		$last = $professor->get_last_name();
		$school = $professor->get_school_name();
		$email = $professor->get_email();
		
		// The ids must not be changed, so they are not updated.
		$query = "update professor set first_name = '$first', last_name = '$last', school_name = '$school', email = '$email' 
				where professor_id = '$professor_id'";		
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$professor)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$user_id = $user_id->get_user_id();
		$first = $professor->get_first_name();
		$last = $professor->get_last_name();
		$school = $professor->get_school_name();
		$email = $professor->get_email();
		
		// The id will be auto-generated.
		$query = "insert into professor (user_id, first_name, last_name, school_name, email) 
				values('$user_id', '$first', '$last', '$school', '$email')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated id
			$professor_id = mysqli_insert_id($db_connection);
			$professor->set_professor_id($professor_id);
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>