<?php


class MemberController extends DatabaseController {

	
	public function __construct() 
	{
		$this->tableName = "member";
	}
	//Member ($member_id, $member_type, $member_name, $member_password, $date_registered, $last_login, $last_logoff)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$the_member = new Member();
				$the_member->initialize($row['member_id'], $row['member_type'], $row['member_name'], $row['member_password'], 
							$row['date_registered'], $row['last_login'], $row['last_logoff']);
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
		$db_connection = $this->get_db_connection();
		$member = new Member();	
		$dataArray = array();	
		
		$query = "select * from member where member_name = '$member_name'"; 
		$result = mysqli_query($db_connection, $query);
		$dataArray = $this->getData($result, $db_connection);
		mysqli_close($db_connection);
		$num = count($dataArray);
		
		if($num > 0)
		{	
			$member = $dataArray[0];
			$member_password = $member->get_member_password();
			$is_match = password_verify($password , $member_password );
			
			if (!$is_match) 
			{	$member = null; 
			}			
		}
		else
		{	$member = null;
		}
		
		return $member;
	}


	// updates the given attribute with the new value in the database and in the member object
	//Member ($member_id, $member_type, $member_name, $member_password, $date_registered, $last_login, $last_logoff)
	public function updateAttribute(&$member, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $member->get_member_id();	
		$query = null;
		
		switch ($attribute)
		{
			case 'member_id':
				return false;
				break;
			case 'member_type':
				$member->set_member_type($value);	
				$query = "update member set member_type = '$value' where member_id = '$member_id'";
				break;
			case 'member_name':
				$member->set_member_name($value);	
				$query = "update member set member_name = '$value' where member_id = '$member_id'";
				break;
			case 'member_password':
				$member->set_member_password($value);	
				$query = "update member set member_password = '$value' where member_id = '$member_id'";
				break;
			case 'date_registered':
				$member->set_date_registered($value);	
				$query = "update member set date_registered = '$value' where member_id = '$member_id'";
				break;
			case 'last_login':
				$member->set_last_login($value);	
				$query = "update member set last_login = '$value' where member_id = '$member_id'";
				break;
			case 'last_logoff':	
				$member->set_last_logoff($value);	
				$query = "update member set last_logoff = '$value' where member_id = '$member_id'";
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
	
	
	// The member_id will be auto-generated, when the new member is added to the database table.
	public function saveNew(&$member)
	{
		$db_connection = $this->get_db_connection();
		$name = $member->get_member_name();
		$member_type = $member->get_member_type();
		$password = $member->get_member_password();
		$date = $member->get_date_registered();
		
		$success = true;
		// The member_id will be auto-generated.
		$query = "insert into member (member_name, member_type, member_password, date_registered) 
				values('$name', '$member_type', '$password', '$date')";
		
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
	

	public function delete_from_database($member)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$member_id = $member->get_member_id();
		
		$query = "delete from member where member_id = $member_id";
		
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