<?php

require_once('../database-access.php');
require_once('../model/Administrator.php');

class Administrator_controller {

	public function Administrator_controller() {}
	//Student ($administrator_id, $user_id, $first_name, $last_name, $admin_type)

	public function get_administrator_by_id($administrator_id)
	{
		$administrator = new Administrator();
		$query = 'select * from administrator where administrator_id = $administrator_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$administrator->initialize($row['administrator_id'], $row['user_id'], $row['first_name'], 
				$row['last_name'], $row['admin_type']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$administrator = null;
		}

		mysqli_close($db_connection);
		return administrator;

	}


	public function get_administrator_by_user_id($user_id)
	{
		$administrator = new Administrator();		
		$query = 'select * from administrator where user_id = $user_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$administrator->initialize($row['administrator_id'], $row['user_id'], $row['first_name'], 
				$row['last_name'], $row['admin_type']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$administrator = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>Student not found.</p>';
		}

		mysqli_close($db_connection);
		return administrator;

	}
	

	public function update_administrator($administrator)
	{
		$sucess = true;
		
		// The administrator_id and user_id should not be changed.
		$query = 'update administrator set first_name = $administrator->first_name, last_name = $administrator->last_name, admin_type = $administrator->admin_type 
		where administrator_id = $administrator->administrator_id';
		
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


	public function save_new_administrator($administrator)
	{
		$sucess = true;
		
		// The administrator_id is not included, because it is set automatically by the database.
		$query = 'insert into administrator (user_id, first_name, last_name, admin_type) 
				values($user_id, $first_name, $last_name, $admin_type)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$administrator->administrator_id = mysql_insert_id();
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