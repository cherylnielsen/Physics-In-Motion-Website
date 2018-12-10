<?php

require_once('../database-access.php');
require_once('../model/Users.php');

class Users_controller {

	public function Users_controller() {}
	//Users ($user_id, $user_name, $user_password, $user_email, $date_joined)

	public function get_user_by_id($user_id)
	{
		$user = new Users();
		$query = 'select * from users where user_id = $user_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$user->initialize($row['user_id'], $row['user_name'], $row['user_password'], 
				$row['user_email'], $row['date_joined']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$user = null;
		}

		mysqli_close($db_connection);
		return user;

	}
	
	
	public function get_user_by_email($user_email)
	{
		$user = new Users();
		$query = 'select * from users where user_email = $user_email';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$user->initialize($row['user_id'], $row['user_name'], $row['user_password'], 
				$row['user_email'], $row['date_joined']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$user = null;
		}

		mysqli_close($db_connection);
		return user;

	}


	public function get_by_login($user_name, $user_password)
	{
		$user = new Users();		
		$query = 'select * from users where (user_name = $user_name) AND (user_password = $user_password)';
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$user->initialize($row['user_id'], $row['user_name'], $row['user_password'], 
				$row['user_email'], $row['date_joined']);;
			}
			mysqli_free_result($result);		
		}
		else
		{
			$user = null;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>User not found. Please double check spelling and capitalization, and try again.</p>';
		}

		mysqli_close($db_connection);
		return user;

	}


	public function save_new_user($user)
	{
		$sucess = true;
		// The user_id is set automatically by the database.
		$query = 'insert into users (user_name, user_password, user_email, date_joined) 
				values($user->user_name, $user->user_password, $user_email->user_email, now())';
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$user->user_id = mysql_insert_id();
			mysqli_free_result($result);					
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New user could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	

	public function update_user($user)
	{
		$sucess = true;
		// The user_id and date_joined should not be changed.
		$query = 'update users set user_name = $user->user_name, user_password = $user->user_password, 
		user_email = $user->user_email  where user_id = $user->user_id';
				
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