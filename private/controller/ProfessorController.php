<?php



class ProfessorController extends DatabaseController{

	
	
	public function __construct() {}
	//Professor ($member_id, $school_name)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$professor = new Professor();
				$professor->set_member_id($row['member_id']);
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
	
	
	// updates the given attribute with the new value in the database and in the professor object
	public function updateAttribute(&$professor, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $professor->get_member_id();	
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'member_id':
				return false;
				break;
			case 'school_name':
				$professor->set_school_name($value);	
				$query = "update $table set school_name = '$value' where member_id = '$member_id'";
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
		$member_id = $professor->get_member_id();
		$school = $professor->get_school_name();
		$table = $this->getTableName();
		
		$query = "insert into $table (member_id, school_name) values('$member_id', '$school')";
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
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $professor->get_member_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where member_id = $member_id";
		
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