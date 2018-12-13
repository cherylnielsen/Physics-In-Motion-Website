<?php


class Administrator_controller extends DatabaseController {

	public function __construct() {}
	//Student ($administrator_id, $user_id, $first_name, $last_name, $admin_type, $email)

	
	public function get_by_attribute($attribute_value, $attribute_type, $db_connection)
	{
		$admin_array = array();
		$query = "select * from administrator where $attribute_type = '$attribute_value'";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$admin = new Administrator();
				$admin->initialize($row['administrator_id'], $row['first_name'], $row['last_name'], $row['admin_type'], $row['email']);
				// pushes each object onto the end of the array
				$admin_array[] = $admin;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $admin_array;

	}
	
	
	public function get_all($db_connection)
	{
		$admin_array = array();
		$query = 'select * from administrator';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$admin = new Administrator();
				$admin->initialize($row['administrator_id'], $row['first_name'], $row['last_name'], $row['admin_type'], $row['email']);
				// pushes each object onto the end of the array
				$admin_array[] = $admin;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $admin_array;

	}
	

	public function update($administrator, $db_connection)
	{
		$sucess = true;
		
		// The administrator_id must match the user_id and should not be changed.
		$query = 'update administrator set first_name = $administrator->first_name, last_name = $administrator->last_name, admin_type = $administrator->admin_type, email = $administrator->email where administrator_id = $administrator->administrator_id';
		
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


	public function save_new($administrator, $db_connection)
	{
		$sucess = true;
		
		// The administrator_id must match the user_id.
		$query = 'insert into administrator (user_id, first_name, last_name, admin_type, email) 
				values($administrator->user_id, $administrator->first_name, $administrator->last_name, $administrator->admin_type, $administrator->email)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$administrator->set_administrator_id(mysql_insert_id());
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New administrator could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>