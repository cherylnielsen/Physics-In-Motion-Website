<?php



class AdministratorController extends DatabaseController {

	
	public function __construct() 
	{
		$this->tableName = "administrator";
	}
	//Administrator ($member_id, $first_name, $last_name, $admin_type, $email)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$admin = new Administrator();
				$admin->initialize($row['member_id'], $row['first_name'], $row['last_name'], $row['admin_type'], $row['email']);
				// pushes each object onto the end of the array
				$dataArray[] = $admin;
			}		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}
	

	// updates the given attribute with the new value in the database and in the administrator object
	public function updateAttribute(&$administrator, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $administrator->get_member_id();	
		
		switch ($attribute)
		{
			case 'member_id':
				return false;
				break;
			case 'first_name':
				$administrator->set_first_name($value);	
				$query = "update administrator set first_name = '$value' where member_id = '$member_id'";
				break;
			case 'last_name':
				$administrator->set_last_name($value);	
				$query = "update administrator set last_name = '$value' where member_id = '$member_id'";
				break;
			case 'admin_type':
				$administrator->set_admin_type($value);	
				$query = "update administrator set admin_type = '$value' where member_id = '$member_id'";
				break;
			case 'email':
				$administrator->set_email($value);	
				$query = "update administrator set email = '$value' where member_id = '$member_id'";
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

	
	public function saveNew(&$administrator)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$member_id = $member_id->get_member_id();
		$first = $administrator->get_first_name();
		$last = $administrator->get_last_name();
		$school = $administrator->get_school_name();
		$email = $administrator->get_email();
		
		
		$query = "insert into administrator (member_id, first_name, last_name, admin_type, email) 
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

	
	public function delete_from_database($administrator)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $administrator->get_admin_id();
		
		$query = "delete from administrator where member_id = $member_id";
		
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