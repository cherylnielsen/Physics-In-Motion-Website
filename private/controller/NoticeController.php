<?php

require_once('model/Notice.php');
require_once('controller/DatabaseController.php');

class NoticeController extends DatabaseController {

	public function __construct() {}
	//($notice_id, $notice_type, $date_sent, $notice_text)

	public function initialize()
	{
		$table = "notice";
		$this->setTableName($table);
	}
	
	private function getData($db_result, &$dataArray)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$notice = new Notice();
				$notice->initialize($row['notice_id'], $row['assignment_id'], $row['notice_type'], $row['date_sent'], $row['notice_text']);
				// pushes each object onto the end of the array
				$dataArray[] = $notice;	
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
	}
	
	
	public function update($notice)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$assignment_id = $notice->get_assignment_id();
		$notice_type = $notice->get_notice_type();
		$notice_text = $notice->get_notice_text();
		
		// The notice_id should not be changed.
		$query = "update notice set assignment_id = '$assignment_id', notice_type = '$notice_type', date_sent = 'now()', notice_text = '$notice_text' where notice_id = '$notice_id'";
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}
	
	
	public function saveNew($notice)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$assignment_id = $notice->get_assignment_id();
		$notice_type = $notice->get_notice_type();
		$notice_text = $notice->get_notice_text();
		
		// The notice_id is not included, because it is set automatically by the database.
		$query = "insert into notice (assignment_id, notice_type, date_sent, notice_text) 
				values('$assignment_id', '$notice_type', 'now()', '$notice_text')";
				
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$notice->set_notice_id(mysql_insert_id($db_connection));
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	
}


?>