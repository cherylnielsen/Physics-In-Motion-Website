<?php



class NoticeController extends DatabaseController {

	
	public function __construct() {}
	//($notice_id, $to_user_id, $from_user_id, $date_sent, $subject, $notice_text)

	public function initialize()
	{
		$this->tableName = "notice";
	}
	
	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$notice = new Notice();
				$notice->initialize($row['notice_id'], $row['to_user_id'], $row['from_user_id'], 
						$row['date_sent'], $row['subject'], $row['notice_text']);
				// pushes each object onto the end of the array
				$dataArray[] = $notice;	
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
	}
	
	
	// The notice_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$notice)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$to_user_id = $notice->get_to_user_id();
		$from_user_id = $notice->get_from_user_id();
		$subject = $notice->get_subject();
		$notice_text = $notice->get_notice_text();
		
		// The notice_id will be auto-generated.
		$query = "insert into notice (to_user_id, from_user_id, date_sent, subject, notice_text) 
				values('$to_user_id', '$from_user_id', 'now()', '$subject', '$notice_text')";
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
	
	
	// updates the given attribute with the new value in the database and in the notice object
	//($notice_id, $to_user_id, $from_user_id, $date_sent, $subject, $notice_text)
	public function update_attribute(&$notice, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$notice_id = $notice->get_notice_id();	
		
		switch ($attribute)
		{
			case $notice_id:
				return false;
				break;
			case $to_user_id:
				$notice->set_to_user_id($value);	
				$query = "update notice set to_user_id = '$value' where notice_id = '$notice_id'";
				break;
			case $from_user_id:
				$notice->set_from_user_id($value);	
				$query = "update notice set from_user_id = '$value' where notice_id = '$notice_id'";
				break;
			case $date_sent:
				$notice->set_date_sent($value);	
				$query = "update notice set date_sent = '$value' where notice_id = '$notice_id'";
				break;
			case $subject:
				$notice->set_subject($value);	
				$query = "update notice set subject = '$value' where notice_id = '$notice_id'";
				break;
			case $notice_text:
				$notice->set_notice_text($value);	
				$query = "update notice set notice_text = '$value' where notice_id = '$notice_id'";
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

	
	public function delete_from_database($notice)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$notice_id = $notice->get_notice_id();
		
		$query = "delete from notice where notice_id = $notice_id";
		
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