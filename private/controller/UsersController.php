<?php

require_once('model/Users.php');
require_once('controller/DatabaseController.php');

class UsersController extends DatabaseController {

	public function __construct() {}
	//Users ($user_id, $user_name, $user_password, $date_registered, $last_login)

	public function initialize()
	{
		$table = "users";
		$this->setTableName($table);
	}

	private function getData($db_result, &$dataArray)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$the_user = new Users();
				$the_user->initialize($row['user_id'], $row['user_name'], $row['user_password'], $row['date_registered'], $row['last_login']);
				// pushes each object onto the end of the array
				$dataArray[] = $the_user;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	public function get_by_login($user_name, $user_password)
	{
		$db_connection = $this->$get_db_connection();
		$user = new Users();	
		$dataArray = array();
		
		$query = "select * from users where (user_name = '$user_name') AND (user_password = '$user_password')";
		$result = mysqli_query($db_connection, $query);
		getData($result, &$dataArray);
		mysqli_close($db_connection);
		
		if(count($dataArray) > 0)
		{
			$user = $dataArray[0];
		}
		
		return $user;
	}


	public function saveNew(&$user)
	{
		$db_connection = $this->$get_db_connection();
		$name = $user->get_user_name();
		$pw = $user->get_user_password();
		$date = $user->get_date_registered();
		
		$sucess = true;
		// The user_id is set automatically by the database.
		$query = "insert into users (user_name, user_password, date_registered, last_login) 
				values('$name', '$pw', '$date', '$last_login')";
		
		$result = mysqli_query($db_connection, $query);
		$id = mysqli_insert_id($db_connection);
		$user->set_user_id($id);			
		
		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
	
		mysqli_close($db_connection);
		return $sucess;		
	}
	

	public function update($user)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$name = $user->get_user_name();
		$pw = $user->get_user_password();
		$date = $user->get_date_registered();
		$last_login = $user->get_last_login();
		$id = $user->get_user_id();
		
		// The user_id should not be changed.
		$query = "update users set user_name = '$name', user_password = '$pw', 
		 date_registered = '$date', last_login = '$last_login'
		 where user_id = '$id'";
				
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;		
	}

}

?>