<?php

require_once('model/Administrator.php');
require_once('controller/DatabaseController.php');

class AdministratorController extends DatabaseController {

	public function __construct() {}
	//Administrator ($administrator_id, $user_id, $first_name, $last_name, $admin_type, $email)

	public function initialize()
	{
		$table = "administrator";
		$this->setTableName($table);
	}

	private function getData($db_result, &$dataArray)
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
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
	}
	

	public function update($administrator)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$first = $administrator->get_first_name();
		$last = $administrator->get_last_name();
		$school = $administrator->get_school_name();
		$email = $administrator->get_email();
		
		// The admin_id must match the user_id and should not be changed.
		$query = "update professor set first_name = '$first', last_name = '$last', school_name = '$school', email = '$email' where admin_id = '$id'";
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The administrator could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function saveNew($administrator)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$id = $administrator->get_admin_id();
		$first = $administrator->get_first_name();
		$last = $administrator->get_last_name();
		$school = $administrator->get_school_name();
		$email = $administrator->get_email();
		
		// The administrator_id must match the user_id.
		$query = "insert into administrator (admin_id, first_name, last_name, admin_type, email) 
				values('$id', '$first', '$last', '$school', '$email')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New administrator could not be saveNewd.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>