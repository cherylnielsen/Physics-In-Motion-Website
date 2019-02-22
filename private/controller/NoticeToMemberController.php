<?php


class NoticeToMemberController extends DatabaseController {

  	
	public function __construct() {}
	//($notice_id, $to_member_id, $flag_read, $flag_important)
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$notice_to_member = new NoticeToMember();
				$notice_to_member->initialize($row['notice_id'], $row['to_member_id'], $row['flag_read'], $row['flag_important']);
				// pushes each object onto the end of the array
				$dataArray[] = $notice_to_member;	
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}
	
	
	public function saveNew(&$notice_to_member)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$notice_id = $notice_to_member->get_notice_id();
		$to_member_id = $notice_to_member->get_to_member_id();
		$flag_read = $notice_to_member->get_flag_read();
		$flag_important = $notice_to_member->get_flag_important();
		$table = $this->getTableName();
		
		$query = "insert into $table (notice_id, to_member_id, flag_read, flag_important) 
				values('$notice_id', '$to_member_id', '$flag_read', '$flag_important')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	// updates the given key with the new value in the database
	// ($notice_id, $to_member_id, $flag_read, $flag_important)
	public function updateAttribute($notice_to_member, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$notice_id = $notice_to_member->get_notice_id();	
		$to_member_id = $notice_to_member->get_to_member_id();
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'notice_id':
			case 'to_member_id':
				return false;
				break;
			case 'flag_read':
				$notice_to_member->get_flag_read();	
				$query = "update $table set flag_read = '$value' where (notice_id = '$notice_id') AND (to_member_id = '$to_member_id')";
				break;
			case 'flag_important':
				$notice_to_member->get_flag_important();	
				$query = "update $table set flag_important = '$value' where (notice_id = '$notice_id') AND (to_member_id = '$to_member_id')";
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

	
	public function deleteFromDatabase($notice_to_member)
	{
		$db_connection = get_db_connection();
		$success = true;
		$notice_id = $notice_to_member->get_notice_id();
		$to_member_id = $notice_to_member->get_to_member_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where (notice_id = '$notice_id') AND (to_member_id = '$to_member_id')";
		
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