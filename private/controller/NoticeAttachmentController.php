<?php


class NoticeAttachmentController extends DatabaseController {

  	
	public function __construct() 
	{
		$this->tableName = "notice";
	}
	//($notice_attachment_id, $notice_id, $attachment)
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$notice_attachment = new Notice_Attachment();
				$notice_attachment->initialize($row['notice_attachment_id'], $row['notice_id'], $row['attachment']);
				// pushes each object onto the end of the array
				$dataArray[] = $notice_attachment;	
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}
	
	
	// The notice_attachment_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$notice_attachment)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$notice_id = $notice_attachment->get_notice_id();
		$notice_subject = $notice_attachment->get_notice_subject();
		$notice_text = $notice_attachment->get_notice_text();
		
		// The notice_attachment_id will be auto-generated.
		$query = "insert into notice_attachment (notice_id, attachment) 
				values('$notice_id', '$attachment')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated notice_attachment_id
			$notice_attachment_id = mysqli_insert_id($db_connection);
			$notice_attachment->set_notice_attachment_id($notice_attachment_id);
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	// updates the given attribute with the new value in the database and in the notice_attachment object
	// ($notice_attachment_id, $notice_id, $attachment)
	public function updateAttribute(&$notice_attachment, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$notice_attachment_id = $notice_attachment->get_notice_attachment_id();	
		
		switch ($attribute)
		{
			case 'notice_attachment_id':
				return false;
				break;
			case 'notice_id':
				$notice_attachment->set_notice_id($value);	
				$query = "update notice_attachment set notice_id = '$value' where notice_attachment_id = '$notice_attachment_id'";
				break;
			case 'attachment':
				$notice_attachment->set_attachment($value);	
				$query = "update notice_attachment set attachment = '$value' where notice_attachment_id = '$notice_attachment_id'";
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

	
	public function delete_from_database($notice_attachment)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$notice_attachment_id = $notice_attachment->get_notice_attachment_id();
		
		$query = "delete from notice_attachment where notice_attachment_id = $notice_attachment_id";
		
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