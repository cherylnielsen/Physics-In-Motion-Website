<?php


class StudentController extends DatabaseController
{
	
	public function __construct() {}
	//Student ($member_id, $school_name)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$student = new Student();
				$student->set_member_id($row['member_id']);
				$student->set_school_name($row['school_name']);
				// pushes each object onto the end of the array
				$dataArray[] = $student;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// updates the given attribute with the new value in the database and in the student object
	public function updateAttribute(&$student, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $student->get_member_id();	
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'member_id':
				return false;
				break;
			case 'school_name':
				$student->set_school_name($value);	
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


	public function saveNew(&$student)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $student->get_member_id();
		$school = $student->get_school_name();
		$table = $this->getTableName();
	
		$query = "insert into $table (member_id, school_name) values('$member_id', '$school')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
		
	}


	public function deleteFromDatabase($student)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $student->get_member_id();
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