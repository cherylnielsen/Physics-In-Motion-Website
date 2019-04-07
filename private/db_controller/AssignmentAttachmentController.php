<?php


class assignmentAttachmentController extends DatabaseController {

	public function __construct() {}
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$assignment_attachment = new Assignment_Attachment();
				$assignment_attachment->initialize($row['assignment_attachment_id'], 
						$row['assignment_id'], $row['filename'], $row['filepath']);
				// pushes each object onto the end of the array
				$dataArray[] = $assignment_attachment;	
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}
	
	
	// The assignment_attachment_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$assignment_attachment)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$assignment_id = $assignment_attachment->get_assignment_id();
		$filename = $assignment_attachment->get_filename();
		$filepath = $assignment_attachment->get_filepath();
		$table = $this->getTableName();
		
		// The assignment_attachment_id will be auto-generated.
		$query = "insert into $table (assignment_id, filename, filepath) 
				values('$assignment_id', '$filename', '$filepath')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated assignment_attachment_id
			$assignment_attachment_id = mysqli_insert_id($db_connection);
			$assignment_attachment->set_assignment_attachment_id($assignment_attachment_id);
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	// updates the given key with the new value in the database 
	// ($assignment_attachment_id, $assignment_id, $filename)
	public function updateAttribute($assignment_attachment, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$assignment_attachment_id = $assignment_attachment->get_assignment_attachment_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'assignment_attachment_id':
				return false;
				break;
			case 'assignment_id':
				$value = $assignment_attachment->get_assignment_id();	
				$query = "update $table set assignment_id = '$value' where assignment_attachment_id = '$assignment_attachment_id'";
				break;
			case 'filename':
				$value = $assignment_attachment->get_filename();	
				$query = "update $table set filename = '$value' where assignment_attachment_id = '$assignment_attachment_id'";
				break;
			case 'filepath':
				$value = $assignment_attachment->get_filepath();	
				$query = "update $table set filepath = '$value' where assignment_attachment_id = '$assignment_attachment_id'";
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

	
	public function updateAll($assignment_attachment)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$assignment_attachment_id = $assignment_attachment->get_assignment_attachment_id();
		
		// data to be updated			
		$assignment_id = $assignment_attachment->get_assignment_id();
		$filename = $assignment_attachment->get_filename();
		$filepath = $assignment_attachment->get_filepath();
			
		$query = "UPDATE $table 
					SET assignment_id = '$assignment_id',
						filename = '$filename',
						filepath = '$filepath'
					WHERE assignment_attachment_id = '$assignment_attachment_id'";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
	}
	
	
	public function deleteFromDatabase($assignment_attachment)
	{
		$db_connection = get_db_connection();
		$success = true;
		$assignment_attachment_id = $assignment_attachment->get_assignment_attachment_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where assignment_attachment_id = $assignment_attachment_id";
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