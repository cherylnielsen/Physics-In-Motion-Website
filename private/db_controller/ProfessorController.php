<?php



class ProfessorController extends DatabaseController{

	
	public function __construct() {}
	//Professor ($professor_id, $school_name)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$professor = new Professor();
				$professor->set_professor_id($row['professor_id']);
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
			case 'school_name':
				$value = $professor->get_school_name();	
				$query = "update $table set school_name = '$value' where professor_id = '$professor_id'";
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
		$sucess = true;
		$professor_id = $professor->get_professor_id();
		$school = $professor->get_school_name();
		$table = $this->getTableName();
		
		$query = "insert into $table (professor_id, school_name) values('$professor_id', '$school')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
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