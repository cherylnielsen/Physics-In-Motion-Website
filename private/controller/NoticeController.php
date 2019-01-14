<?php

require_once('model/Notice.php');
require_once('controller/DatabaseController.php');

class NoticeController extends DatabaseController {

	public function __construct() {}
	//($notice_id, $to_user_id, $from_user_id, $date_sent, $subject, $notice_text)

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
	
	
	// The notice_id must not be changed, so it is not updated.
	public function update($notice)
	{
		$db_connection = $this->$get_db_connection();
		$sucess = true;
		$notice_id = $notice->get_notice_id();
		$to_user_id = $notice->get_to_user_id();
		$from_user_id = $notice->get_from_user_id();
		$date_sent = $notice->get_date_sent();
		$subject = $notice->get_subject();
		$notice_text = $notice->get_notice_text();
		
		// The notice_id must not be changed, so it is not updated.
		$query = "update notice set to_user_id = '$to_user_id', from_user_id = '$from_user_id', 
					date_sent = '$date_sent', subject = '$subject', notice_text = '$notice_text' 
					where notice_id = '$notice_id'";		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;

	}
	
	
	// The notice_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$notice)
	{
		$db_connection = $this->$get_db_connection();
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
	
}


?>