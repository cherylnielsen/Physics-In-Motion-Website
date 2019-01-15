<?php



class AdministratorController extends DatabaseController {

	public function __construct() {}
	//Administrator ($administrator_id, $user_id, $first_name, $last_name, $admin_type, $email)

	public function initialize()
	{
		$table = "administrator";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$admin = new Administrator();
				$admin->initialize($row['admin_id'], $row['user_id'], $row['first_name'], $row['last_name'], $row['admin_type'], $row['email']);
				// pushes each object onto the end of the array
				$dataArray[] = $admin;
			}		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
	}
	

	// The ids must not be changed, so they are not updated.
	public function update($administrator)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$admin_id = $administrator->get_admin_id();
		$first = $administrator->get_first_name();
		$last = $administrator->get_last_name();
		$school = $administrator->get_school_name();
		$email = $administrator->get_email();
		
		// The ids must not be changed, so they are not updated.
		$query = "update professor set first_name = '$first', last_name = '$last', school_name = '$school', email = '$email' 
					where admin_id = '$admin_id'";
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;

	}

	
	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$administrator)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$user_id = $user_id->get_user_id();
		$first = $administrator->get_first_name();
		$last = $administrator->get_last_name();
		$school = $administrator->get_school_name();
		$email = $administrator->get_email();
		
		// The admin_id will be auto-generated.
		$query = "insert into administrator (user_id, first_name, last_name, admin_type, email) 
				values('$user_id', '$first', '$last', '$school', '$email')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated admin_id
			$admin_id = mysqli_insert_id($db_connection);
			$administrator->set_admin_id($admin_id);
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>