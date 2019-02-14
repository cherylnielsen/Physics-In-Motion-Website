<?php



class AdministratorController extends DatabaseController {

	
	public function __construct() {}
	//Administrator ($member_id, $admin_type)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$admin = new Administrator();
				$admin->set_member_id($row['member_id']);
				$admin->set_admin_type($row['admin_type']);
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
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'member_id':
				return false;
				break;
			case 'admin_type':
				$administrator->set_admin_type($value);	
				$query = "update $table set admin_type = '$value' where member_id = '$member_id'";
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
		$school = $administrator->get_school_name();
		$table = $this->getTableName();
		
		$query = "insert into $table (member_id, admin_type) values('$member_id', '$admin_type')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}

	
	public function deleteFromDatabase($administrator)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $administrator->get_admin_id();
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