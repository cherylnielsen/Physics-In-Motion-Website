<?php


class NoticeAttachmentController extends DatabaseController {

	public function __construct() {}
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$notice_attachment = new Notice_Attachment();
				$notice_attachment->initialize($row['notice_attachment_id'], $row['notice_id'], 
									$row['filename'], $row['filepath']);
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
		$db_connection = get_db_connection();
		$sucess = true;
		$notice_id = $notice_attachment->get_notice_id();
		$filename = $notice_attachment->get_filename();
		$filepath = $notice_attachment->get_filepath();
		$table = $this->getTableName();
		
		// The notice_attachment_id will be auto-generated.
		$query = "insert into $table (notice_id, attachment) 
				values('$notice_id', '$filename', '$filepath')";
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

		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	// updates the given key with the new value in the database 
	// ($notice_attachment_id, $notice_id, $filename)
	public function updateAttribute($notice_attachment, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$notice_attachment_id = $notice_attachment->get_notice_attachment_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'notice_attachment_id':
				return false;
				break;
			case 'notice_id':
				$value = $notice_attachment->get_notice_id();	
				$query = "update $table set notice_id = '$value' where notice_attachment_id = '$notice_attachment_id'";
				break;
			case 'filename':
				$value = $notice_attachment->get_filename();	
				$query = "update $table set filename = '$value' where notice_attachment_id = '$notice_attachment_id'";
				break;
			case 'filepath':
				$value = $notice_attachment->get_filepath();	
				$query = "update $table set filepath = '$value' where notice_attachment_id = '$notice_attachment_id'";
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

	
	public function updateAll($notice_attachment)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$notice_attachment_id = $notice_attachment->get_notice_attachment_id();
		
		// data to be updated			
		$notice_id = $notice_attachment->get_notice_id();
		$filename = $notice_attachment->get_filename();
		$filepath = $notice_attachment->get_filepath();
			
		$query = "UPDATE $table 
					SET notice_id = '$notice_id',
						filename = '$filename',
						filepath = '$filepath'
					WHERE notice_attachment_id = '$notice_attachment_id'";
						
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
		$db_connection = get_db_connection();
		$success = true;
		$notice_attachment_id = $notice_attachment->get_notice_attachment_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where notice_attachment_id = $notice_attachment_id";
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