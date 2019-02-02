<?php



class AdministratorController extends DatabaseController {

	
	public function __construct() {}
	//Administrator ($administrator_id, $user_id, $first_name, $last_name, $admin_type, $email)

	public function initialize()
	{
		$this->tableName = "administrator";
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
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
	

	// updates the given attribute with the new value in the database and in the administrator object
	public function update_attribute(&$administrator, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$administrator_id = $administrator->get_administrator_id();	
		
		switch ($attribute)
		{
			case $administrator_id:
			case $user_id:
				return false;
				break;
			case $first_name:
				$administrator->set_first_name($value);	
				$query = "update administrator set first_name = '$value' where administrator_id = '$administrator_id'";
				break;
			case $last_name:
				$administrator->set_last_name($value);	
				$query = "update administrator set last_name = '$value' where administrator_id = '$administrator_id'";
				break;
			case $admin_type:
				$administrator->set_admin_type($value);	
				$query = "update administrator set admin_type = '$value' where administrator_id = '$administrator_id'";
				break;
			case $email:
				$administrator->set_email($value);	
				$query = "update administrator set email = '$value' where administrator_id = '$administrator_id'";
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

		mysqli_close($db_connection);
		return $sucess;
		
	}

	
	public function delete_from_database($administrator)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$admin_id = $administrator->get_admin_id();
		
		$query = "delete from administrator where admin_id = $admin_id";
		
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