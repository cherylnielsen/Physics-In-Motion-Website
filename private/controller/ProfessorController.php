<?php

require_once('model/Professor.php');
require_once('controller/DatabaseController.php');

class ProfessorController extends DatabaseController{

	public function __construct() {}
	//Professor ($professor_id, $user_id, $first_name, $last_name, $school_name, $email)

	public function initialize()
	{
		$table = "professor";
		$this->setTableName($table);
	}

	private function getData($db_result, &$dataArray)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$professor = new Professor();
				$professor->initialize($row['professor_id'], $row['user_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
				// pushes each object onto the end of the array
				$dataArray[] = $professor;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
	}
	
	
	public function update($professor)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$first = $professor->get_first_name();
		$last = $professor->get_last_name();
		$school = $professor->get_school_name();
		$email = $professor->get_email();
		
		// The professor_id must match the user_id, and should not be changed.
		$query = "update professor set first_name = '$first', last_name = '$last', school_name = '$school', email = '$email' where professor_id = '$id'";
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function saveNew($professor)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$id = $professor->get_professor_id();
		$first = $professor->get_first_name();
		$last = $professor->get_last_name();
		$school = $professor->get_school_name();
		$email = $professor->get_email();
		
		// The professor_id must match the user_id.
		$query = "insert into professor (professor_id, first_name, last_name, school_name, email) 
				values('$id', '$first', '$last', '$school', '$email')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>