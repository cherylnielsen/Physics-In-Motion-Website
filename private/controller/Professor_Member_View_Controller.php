<?php


class Professor_Member_View_Controller extends DatabaseController
{
	
	public function __construct() {}
	// $professor_id, $professor_name, $email, $school_name


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$professor = new Professor_Member_View();
				$professor->set_professor_id($row['professor_id']);
				$professor->set_professor_name($row['professor_name']);
				$professor->set_email($row['email']);
				$professor->set_school_name($row['school_name']);
				// pushes each object onto the end of the array
				$dataArray[] = $professor;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// updates the given key with the new value in the database
	public function updateAttribute($professor, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$professor_id = $professor->get_professor_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'professor_id':
				return false;
				break;
			case 'professor_name':
				$value = $professor->get_professor_name();
				$query = "update $table set professor_name = '$value' where professor_id = '$professor_id'";
				break;
			case 'school_name':
				$value = $professor->get_school_name();
				$query = "update $table set school_name = '$value' where professor_id = '$professor_id'";
				break;
			case 'email':
				$value = $professor->get_email();
				$query = "update $table set email = '$value' where professor_id = '$professor_id'";
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
		$db_connection = get_db_connection();
		$success = true;
		$professor_id = $professor->get_professor_id();
		$professor_name = $professor->get_professor_name();
		$email = $professor->get_email();
		$school_name = $professor->get_school_name();
		$table = $this->getTableName();
	
		$query = "insert into $table (professor_id, professor_name, email, school_name) 
					values('$professor_id', '$professor_name', '$email', '$school_name')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
		
	}


	public function deleteFromDatabase($professor)
	{
		$db_connection = get_db_connection();
		$success = true;
		$professor_id = $professor->get_professor_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where professor_id = $professor_id";
		
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