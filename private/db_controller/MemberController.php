<?php

class MemberController extends DatabaseController {

	public function __construct() {}
	// ($member_id, $member_type, $member_name, $member_password, 
	// $date_registered, $last_login, $last_logoff,
	// $first_name, $last_name, $email, $registration_complete)

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$the_member = new Member();
				$the_member->initialize($row['member_id'], $row['member_type'], 
							$row['member_name'], 
							$row['member_password'], $row['date_registered'], 
							$row['last_login'], 
							$row['last_logoff'],
							$row['first_name'], $row['last_name'], $row['email'], 
							$row['registration_complete']);
				// pushes each object onto the end of the array
				$dataArray[] = $the_member;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	public function get_by_login($member_name, $password)
	{
		$db_connection = get_db_connection();
		$member = new Member();	
		$dataArray = array();	
		$table = $this->getTableName();
		
		$query = "select * from $table where member_name = '$member_name'"; 
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);
		mysqli_close($db_connection);
		$num = count($dataArray);
			
		if($num == 1)
		{	
			$member = $dataArray[0];
			$member_password = $member->get_member_password();
			$is_match = password_verify($password , $member_password );
			
			if (!$is_match) 
			{	$member = null; 
			}			
		}
		else
		{	
			$member = null; 
		}
		
		return $member;
	}


	/***
	Queries the database for an array of objects that all have $key = $value.
	Input: the set of keys and values to search for in the database table.
	Output: $dataArray = the array of object models created from each result row.
	***/
	public function getByAttributeSet($key1, $value1, $key2, $value2, 
										$key3, $value3, $key4, $value4)
	{
		$table = $this->getTableName();
		$db_connection = get_db_connection();
		$dataArray = array();
		
		$query = "select * from $table where ($key1 = '$value1') 
						AND ($key2 = '$value2') AND ($key3 = '$value3') 
						AND ($key4 = '$value4')";		
		
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);
		mysqli_close($db_connection);	
		
		return $dataArray;
	}
	

	// updates the given key with the new value in the database
	//Member ($member_id, $member_type, $member_name, $member_password, $date_registered, $last_login, $last_logoff
	//			$first_name, $last_name, $email, $registration_complete)
	public function updateAttribute($member, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$member_id = $member->get_member_id();	
		$query = null;
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'member_id':
				return false;
				break;
			case 'member_type':
				$value = $member->get_member_type();	
				$query = "update $table set member_type = '$value' where member_id = '$member_id'";
				break;
			case 'member_name':
				$value = $member->get_member_name();	
				$query = "update $table set member_name = '$value' where member_id = '$member_id'";
				break;
			case 'member_password':
				$value = $member->get_member_password();	
				$query = "update $table set member_password = '$value' where member_id = '$member_id'";
				break;
			case 'date_registered':
				$value = $member->get_date_registered();	
				$query = "update $table set date_registered = '$value' where member_id = '$member_id'";
				break;
			case 'last_login':
				$value = $member->get_last_login();	
				$query = "update $table set last_login = '$value' where member_id = '$member_id'";
				break;
			case 'last_logoff':	
				$value = $member->get_last_logoff();	
				$query = "update $table set last_logoff = '$value' where member_id = '$member_id'";
				break;
			case 'first_name':
				$value = $member->get_first_name();	
				$query = "update $table set first_name = '$value' where member_id = '$member_id'";
				break;
			case 'last_name':
				$value = $member->get_last_name();	
				$query = "update $table set last_name = '$value' where member_id = '$member_id'";
				break;
			case 'email':
				$value = $member->get_email();	
				$query = "update $table set email = '$value' where member_id = '$member_id'";
				break;
			case 'registration_complete':	
				$value = $member->get_registration_complete();	
				$query = "update $table set registration_complete = '$value' where member_id = '$member_id'";
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
	
	
	public function updateAll($member)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$member_id = $member->get_member_id();
		
		// data to be updated			
		$member_type = $member->get_member_type();
		$member_name = $member->get_member_name();
		$member_password = $member->get_member_password();		
		$date_registered = $member->get_date_registered();
		$last_login = $member->get_last_login();
		$last_logoff = $member->get_last_logoff();		
		$first_name = $member->get_first_name();
		$last_name = $member->get_last_name();
		$email = $member->get_email();
		$registration_complete = $member->get_registration_complete();
			
		$query = "UPDATE $table 
					SET member_type = '$member_type',
						member_name = '$member_name',
						member_password = '$member_password',
						date_registered = '$date_registered',
						last_login = '$last_login',
						last_logoff = '$last_logoff',
						first_name = '$first_name',
						email = '$email',
						registration_complete = '$registration_complete' 
					WHERE member_id = '$member_id'";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
	}
	
	
	// The member_id will be auto-generated, when the new member is added to the database table.
	// Member ($member_id, $member_type, $member_name, $member_password, $date_registered, 
	// $last_login, $last_logoff, $first_name, $last_name, $email, $registration_complete)
	public function saveNew(&$member)
	{
		$db_connection = get_db_connection();
		$name = $member->get_member_name();
		$member_type = $member->get_member_type();
		$password = $member->get_member_password();
		$date = $member->get_date_registered();
		// $last_login = null;  // new member
		// $last_logoff = null; // new member
		$first_name = $member->get_first_name();
		$last_name = $member->get_last_name();
		$email = $member->get_email();
		$registration_complete = $member->get_registration_complete();
		
		$table = $this->getTableName();
		
		$success = true;
		// The member_id will be auto-generated.
		$query = "insert into $table (member_type, member_name, member_password, 
						date_registered, first_name, last_name, email, registration_complete) 
				values('$member_type', '$name', '$password', '$date', 
						'$first_name', '$last_name', '$email', '$registration_complete')";
		
		$result = mysqli_query($db_connection, $query);			
		
		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated member_id
			$member_id = mysqli_insert_id($db_connection);
			$member->set_member_id($member_id);
		}
	
		mysqli_close($db_connection);
		return $success;		
	}
	

	public function deleteFromDatabase($member)
	{
		$db_connection = get_db_connection();
		$success = true;
		$member_id = $member->get_member_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where member_id = $member_id";
		$result = mysqli_query($db_connection, $query);
		
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