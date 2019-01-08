<?php


class Users_controller extends DatabaseController {

	public function __construct() {}
	//Users ($user_id, $user_name, $user_password, $user_type)

	
	
	public function get_by_attribute($attribute_value, $attribute_type, $db_connection)
	{
		$user_array = array();
		$query = "select * from users where $attribute_type = '$attribute_value'";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$the_user = new Users();
				$the_user->initialize($row['user_id'], $row['user_name'], $row['user_password'], $row['user_type']);
				// pushes each object onto the end of the array
				$user_array[] = $the_user;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $user_array;
	}
	
	
	public function get_all($db_connection)
	{
		$user_array = array();
		$query = 'select * from users';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$the_user = new Users();
				$the_user->initialize($row['user_id'], $row['user_name'], $row['user_password'], $row['user_type']);
				// pushes each object onto the end of the array
				$user_array[] = $the_user;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $user_array;

	}
	

	public function get_by_login($user_name, $user_password, $db_connection)
	{
		$user = new Users();		
		$query = "select * from users where (user_name = '$user_name') AND (user_password = '$user_password')";
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$user->initialize($row['user_id'], $row['user_name'], $row['user_password'], $row['user_type']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			$user = NULL;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>User not found. Please double check spelling and capitalization, and try again.</p>';
		}

		mysqli_close($db_connection);
		return $user;
	}


	public function save_new($user, $db_connection)
	{
		$name = $user->get_user_name();
		$pw = $user->get_user_password();
		$str = $user->get_user_type();
		$sucess = true;
		// The user_id is set automatically by the database.
		$query = "insert into users (user_name, user_password, user_type) 
				values('$name', '$pw', '$str')";
		
		$result = mysqli_query($db_connection, $query);
		$id = mysqli_insert_id($db_connection);
		$user->set_user_id($id);			
		
		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New user could not be saved.</p>';
		}
	
		mysqli_close($db_connection);
		return $sucess;		
	}
	

	public function update($user, $db_connection)
	{
		$sucess = true;
		$name = $user->get_user_name();
		$pw = $user->get_user_password();
		$str = $user->get_user_type();
		$id = $user->get_user_id();
		
		// The user_id should not be changed.
		$query = "update users set user_name = '$name', user_password = '$pw', 
		 user_type = '$str' where user_id = '$id'";
				
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>User could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;		
	}

}

?>