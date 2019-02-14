<?php



class ProfessorController extends DatabaseController{

	
	
	public function __construct() {}
	//Professor ($member_id, $first_name, $last_name, $school_name, $email)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$professor = new Professor();
				$professor->initialize($row['member_id'], $row['first_name'], $row['last_name'], $row['school_name'], $row['email']);
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
			case 'first_name':
				$professor->set_first_name($value);	
				$query = "update $table set first_name = '$value' where member_id = '$member_id'";
				break;
			case 'last_name':
				$professor->set_last_name($value);	
				$query = "update $table set last_name = '$value' where member_id = '$member_id'";
				break;
			case 'school_name':
				$professor->set_school_name($value);	
				$query = "update $table set school_name = '$value' where member_id = '$member_id'";
				break;
			case 'email':
				$professor->set_email($value);	
				$query = "update $table set email = '$value' where member_id = '$member_id'";
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
		$first = $professor->get_first_name();
		$last = $professor->get_last_name();
		$school = $professor->get_school_name();
		$email = $professor->get_email();
		$table = $this->getTableName();
		
		$query = "insert into $table (member_id, first_name, last_name, school_name, email) 
				values('$member_id', '$first', '$last', '$school', '$email')";
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