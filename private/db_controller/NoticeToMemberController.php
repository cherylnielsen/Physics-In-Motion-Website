<?php


class NoticeToMemberController extends DatabaseController {

  	
	public function __construct() {}
	//($notice_id, $to_member_id)
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$notice_to_member = new NoticeToMember();
				$notice_to_member->initialize($row['notice_id'], $row['to_member_id']);
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
		$table = $this->getTableName();
		
		$query = "insert into $table (notice_id, to_member_id) 
				values('$notice_id', '$to_member_id')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	// NOTHING to update, both items in the table form the joint primary key for each row
	// ($notice_id, $to_member_id)
	public function updateAttribute($notice_to_member, $key)
	{
		return false;		
	}
	
	
	// NOTHING to update, both items in the table form the joint primary key for each row
	// ($notice_id, $to_member_id)
	public function updateAll($notice_to_member)
	{
		return false;		
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