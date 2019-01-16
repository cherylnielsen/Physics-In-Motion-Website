<?php



class UsersController extends DatabaseController {

	public function __construct() {}
	//Users ($user_id, $user_name, $user_password, $date_registered, $last_login)

	public function initialize()
	{
		$table = "users";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$the_user = new Users();
				$the_user->initialize($row['user_id'], $row['user_name'], $row['user_password'], $row['date_registered'], $row['last_login']);
				// pushes each object onto the end of the array
				$dataArray[] = $the_user;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	public function get_by_login($user_name, $user_password)
	{
		$db_connection = $this->get_db_connection();
		$user = new Users();	
		$dataArray = array();
		
		$query = "select * from users where (user_name = '$user_name') AND (user_password = '$user_password')";
		$result = mysqli_query($db_connection, $query);
		$this->getData($result, $dataArray);
		mysqli_free_result($result);
		mysqli_close($db_connection);
		
		if(count($dataArray) > 0)
		{
			$user = $dataArray[0];
		}
		else
		{
			$user = null;
		}
		
		return $user;
	}


	public function update_last_login($user_id, $last_login)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;		
		$query = "update users set last_login = '$last_login' where user_id = '$user_id'";				
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;		
	}
	

	// The user_id must not be changed, so it is not updated.
	public function update($user)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$name = $user->get_user_name();
		$pw = $user->get_user_password();
		$date = $user->get_date_registered();
		$last_login = $user->get_last_login();
		$user_id = $user->get_user_id();
		
		// The user_id must not be changed, so it is not updated.
		$query = "update users set user_name = '$name', user_password = '$pw', 
		 date_registered = '$date', last_login = '$last_login'
		 where user_id = '$user_id'";
				
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;		
	}
	

	// The user_id will be auto-generated, when the new user is added to the database table.
	public function saveNew(&$user)
	{
		$db_connection = $this->get_db_connection();
		$name = $user->get_user_name();
		$pw = $user->get_user_password();
		$last_login = $user->get_last_login();
		
		$sucess = true;
		// The user_id will be auto-generated.
		$query = "insert into users (user_name, user_password, date_registered, last_login) 
				values('$name', '$pw', 'now()', '$last_login')";
		
		$result = mysqli_query($db_connection, $query);			
		
		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated user_id
			$user_id = mysqli_insert_id($db_connection);
			$user->set_user_id($user_id);
		}
	
		mysqli_close($db_connection);
		return $sucess;		
	}
	

}

?>