<?php


class UsersController extends DatabaseController {

	
	public function __construct() {}
	//Users ($user_id, $user_type, $user_name, $user_password, $date_registered, $last_login, $last_logoff)

	public function initialize()
	{
		$this->tableName = "users";
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$the_user = new Users();
				$the_user->initialize($row['user_id'], $row['user_type'], $row['user_name'], $row['user_password'], 
							$row['date_registered'], $row['last_login'], $row['last_logoff']);
				// pushes each object onto the end of the array
				$dataArray[] = $the_user;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	public function get_by_login($user_name, $password)
	{
		$db_connection = $this->get_db_connection();
		$user = new Users();	
		$dataArray = array();	
		
		$query = "select * from users where user_name = '$user_name'"; 
		$result = mysqli_query($db_connection, $query);
		$this->getData($result, $dataArray, $db_connection);
		mysqli_close($db_connection);
		$num = count($dataArray);
		
		if($num > 0)
		{	
			$user = $dataArray[0];
			$user_password = $user->get_user_password();
			$is_match = password_verify($password , $user_password );
			
			if (!$is_match) 
			{	$user = null; 
			}			
		}
		else
		{	$user = null;
		}
		
		return $user;
	}


	// updates the given attribute with the new value in the database and in the user object
	//Users ($user_id, $user_type, $user_name, $user_password, $date_registered, $last_login, $last_logoff)
	public function update_attribute(&$user, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $user->get_user_id();	
		$query = null;
		
		switch ($attribute)
		{
			case 'user_id':
				return false;
				break;
			case 'user_type':
				$user->set_user_type($value);	
				$query = "update users set user_type = '$value' where user_id = '$user_id'";
				break;
			case 'user_name':
				$user->set_user_name($value);	
				$query = "update users set user_name = '$value' where user_id = '$user_id'";
				break;
			case 'user_password':
				$user->set_user_password($value);	
				$query = "update users set user_password = '$value' where user_id = '$user_id'";
				break;
			case 'date_registered':
				$user->set_date_registered($value);	
				$query = "update users set date_registered = '$value' where user_id = '$user_id'";
				break;
			case 'last_login':
				$user->set_last_login($value);	
				$query = "update users set last_login = '$value' where user_id = '$user_id'";
				break;
			case 'last_logoff':	
				$user->set_last_logoff($value);	
				$query = "update users set last_logoff = '$value' where user_id = '$user_id'";
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
	
	
	// The user_id will be auto-generated, when the new user is added to the database table.
	public function saveNew(&$user)
	{
		$db_connection = $this->get_db_connection();
		$name = $user->get_user_name();
		$user_type = $user->get_user_type();
		$password = $user->get_user_password();
		$date = $user->get_date_registered();
		
		$success = true;
		// The user_id will be auto-generated.
		$query = "insert into users (user_name, user_type, user_password, date_registered) 
				values('$name', '$user_type', '$password', '$date')";
		
		$result = mysqli_query($db_connection, $query);			
		
		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated user_id
			$user_id = mysqli_insert_id($db_connection);
			$user->set_user_id($user_id);
		}
	
		mysqli_close($db_connection);
		return $success;		
	}
	

	public function delete_from_database($user)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$user_id = $user->get_user_id();
		
		$query = "delete from users where user_id = $user_id";
		
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