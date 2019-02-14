<?php


class NoticeReceivedController extends DatabaseController {

  	
	public function __construct() {}
	//($notice_id, $to_member_id, $flag_read, $flag_important)
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$recieved = new Notice_Received();
				$recieved->initialize($row['notice_id'], $row['to_member_id'], $row['flag_read'], $row['flag_important']);
				// pushes each object onto the end of the array
				$dataArray[] = $recieved;	
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}
	
	
	public function saveNew(&$notice_received)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$notice_id = $notice_recieved->get_notice_id();
		$to_member_id = $notice_recieved->get_to_member_id();
		$flag_read = $notice_recieved->get_flag_read();
		$flag_important = $notice_recieved->get_flag_important();
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
	
	
	// updates the given attribute with the new value in the database and in the notice_recieved object
	// ($notice_id, $to_member_id, $flag_read, $flag_important)
	public function updateAttribute(&$notice_recieved, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$notice_id = $notice_recieved->get_notice_id();	
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'notice_id':
				return false;
				break;
			case 'to_member_id':
				$notice_recieved->set_to_member_id($value);	
				$query = "update $table set notice_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'flag_read':
				$notice_recieved->set_flag_read($value);	
				$query = "update $table set flag_read = '$value' where notice_id = '$notice_id'";
				break;
			case 'flag_important':
				$notice_recieved->set_flag_important($value);	
				$query = "update $table set flag_important = '$value' where notice_id = '$notice_id'";
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

	
	public function deleteFromDatabase($notice_attachment)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$notice_id = $notice_attachment->get_notice_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where notice_id = $notice_id";
		
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