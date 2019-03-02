<?php


/***
Notice = ($notice_id, $from_member_id, $response_to_notice_id, $date_sent, $notice_subject, $notice_text, $flag_for_review)
***/
class NoticeController extends DatabaseController {

  	
	public function __construct() {}
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$notice = new Notice();
				$notice->initialize($row['notice_id'], $row['from_member_id'], 
							$row['date_sent'], 
							$row['notice_subject'], $row['notice_text'], 
							$row['response_to_notice_id'], 
							$row['flag_for_review']);
				// pushes each object onto the end of the array
				$dataArray[] = $notice;	
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}
	
	
	// The notice_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$notice)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$from_member_id = $notice->get_from_member_id();
		$from_date_sent = $notice->get_date_sent();
		$notice_subject = $notice->get_notice_subject();
		$notice_text = $notice->get_notice_text();
		$response_to_notice_id = $notice->get_response_to_notice_id();
		$flag_for_review = $notice->get_flag_for_review();
		$table = $this->getTableName();
		
		// The notice_id will be auto-generated.
		$query = "insert into $table (from_member_id, date_sent, notice_subject, 
							notice_text, response_to_notice_id, flag_for_review) 
				values('$from_member_id', 'now()', '$notice_subject', 
							'$notice_text', '$response_to_notice_id', '$flag_for_review')";
							
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated notice_id
			$notice_id = mysqli_insert_id($db_connection);
			$notice->set_notice_id($notice_id);
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	// updates the given key with the new value in the database
	//($notice_id, $to_member_id, $from_member_id, $date_sent, $notice_subject, $notice_text)
	public function updateAttribute($notice, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$notice_id = $notice->get_notice_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'notice_id':
				return false;
				break;
			case 'from_member_id':
				$value = $notice->get_from_member_id();	
				$query = "update $table set from_member_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'date_sent':
				$value = $notice->get_date_sent();	
				$query = "update $table set date_sent = '$value' where notice_id = '$notice_id'";
				break;
			case 'notice_subject':
				$value = $notice->get_notice_subject();	
				$query = "update $table set notice_subject = '$value' where notice_id = '$notice_id'";
				break;
			case 'notice_text':
				$value = $notice->get_notice_text();	
				$query = "update $table set notice_text = '$value' where notice_id = '$notice_id'";
				break;
			case 'response_to_notice_id':
				$value = $notice->get_response_to_notice_id();	
				$query = "update $table set response_to_notice_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'flag_for_review':
				$value = $notice->get_flag_for_review();	
				$query = "update $table set flag_for_review = '$value' where notice_id = '$notice_id'";
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

	
	public function deleteFromDatabase($notice)
	{
		$db_connection = get_db_connection();
		$success = true;
		$notice_id = $notice->get_notice_id();
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