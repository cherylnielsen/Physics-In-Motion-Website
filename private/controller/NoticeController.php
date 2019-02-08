<?php


class NoticeController extends DatabaseController {

  	
	public function __construct() 
	{
		$this->tableName = "notice";
	}
	//($notice_id, $from_member_id, $to_section_id, $date_sent, $notice_subject, $notice_text)
	
	
	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$notice = new Notice();
				$notice->initialize($row['notice_id'], $row['from_member_id'], $row['to_section_id'],
						$row['date_sent'], $row['notice_subject'], $row['notice_text']);
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
		$from_member_id = $notice->get_from_member_id();
		$to_section_id = $notice->get_to_section_id();
		$notice_subject = $notice->get_notice_subject();
		$notice_text = $notice->get_notice_text();
		
		// The notice_id will be auto-generated.
		$query = "insert into notice (from_member_id, to_section_id, date_sent, notice_subject, notice_text) 
				values('$from_member_id', '$to_section_id, ', 'now()', '$notice_subject', '$notice_text')";
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
	//($notice_id, $to_member_id, $from_member_id, $date_sent, $notice_subject, $notice_text)
	public function update_attribute(&$notice, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$notice_id = $notice->get_notice_id();	
		
		switch ($attribute)
		{
			case 'notice_id':
				return false;
				break;
			case 'from_member_id':
				$notice->set_from_member_id($value);	
				$query = "update notice set from_member_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'to_section_id':
				$notice->set_to_section_id($value);	
				$query = "update notice set to_section_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'date_sent':
				$notice->set_date_sent($value);	
				$query = "update notice set date_sent = '$value' where notice_id = '$notice_id'";
				break;
			case 'notice_subject':
				$notice->set_notice_subject($value);	
				$query = "update notice set notice_subject = '$value' where notice_id = '$notice_id'";
				break;
			case 'notice_text':
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