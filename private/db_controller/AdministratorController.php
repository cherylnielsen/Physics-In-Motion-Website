<?php



class AdministratorController extends DatabaseController {

	
	public function __construct() {}
	//Administrator ($administrator_id, $admin_type)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$admin = new Administrator();
				$admin->set_administrator_id($row['administrator_id']);
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
	

	// updates the given key with the new value in the database
	public function updateAttribute($administrator, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$administrator_id = $administrator->get_administrator_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'administrator_id':
				return false;
				break;
			case 'admin_type':
				$value = $administrator->get_admin_type();	
				$query = "update $table set admin_type = '$value' where administrator_id = '$administrator_id'";
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

	
	public function updateAll($administrator)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$administrator_id = $administrator->get_administrator_id();
		
		// data to be updated			
		$admin_type = $administrator->get_admin_type();
			
		$query = "UPDATE $table 
					SET admin_type = '$admin_type'
					WHERE administrator_id = '$administrator_id'";
						
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
		$db_connection = get_db_connection();
		$sucess = true;
		$administrator_id = $administrator_id->get_administrator_id();
		$school = $administrator->get_school_name();
		$table = $this->getTableName();
		
		$query = "insert into $table (administrator_id, admin_type) values('$administrator_id', '$admin_type')";
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
		$db_connection = get_db_connection();
		$success = true;
		$administrator_id = $administrator->get_administrator_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where administrator_id = $administrator_id";
		$result = mysqli_query($db_connection, $query);
		
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