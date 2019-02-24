<?php

/***
($notice_id, $from_member_id, $from_member_name, $to_member_id, $date_sent, $notice_subject, $notice_text, 
$response_to_notice_id, $to_section_id, $sent_high_priority, 
$flag_read, $flag_important, $flag_for_review)
***/

class Notice_View_Controller extends DatabaseController {

  	
	public function __construct() {}
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$notice_view = new Notice_View();
				$notice_view->initialize($row['notice_id'], $row['from_member_id'], $row['from_member_name'], 
							$row['to_member_id'], $row['date_sent'], 
							$row['notice_subject'], $row['notice_text'], $row['response_to_notice_id'], $row['to_section_id'], 
							$row['sent_high_priority'], $row['flag_read'], $row['flag_important'], $row['flag_for_review']);
				// pushes each object onto the end of the array
				$dataArray[] = $notice_view;	
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}
	
	
	// The notice_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$notice_view)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$from_member_id = $notice_view->get_from_member_id();
		$from_member_name = $notice_view->get_from_member_name();
		$to_member_id = $notice_view->get_to_member_id();
		$from_date_sent = $notice_view->get_date_sent();
		$notice_subject = $notice_view->get_notice_subject();
		$notice_text = $notice_view->get_notice_text();
		$response_to_notice_id = $notice_view->get_response_to_notice_id();
		$to_section_id = $notice_view->get_to_section_id();		
		$sent_high_priority = $notice_view->get_sent_high_priority();
		$flag_read = $notice_view->get_flag_read();
		$flag_important = $notice_view->get_flag_important();
		$flag_for_review = $notice_view->get_flag_for_review();
		$table = $this->getTableName();
		
		// The notice_id will be auto-generated.
		$query = "insert into $table (notice_id, from_member_id, from_member_name, to_member_id, date_sent, 
								notice_subject, notice_text, 
								response_to_notice_id, to_section_id, sent_high_priority, 
								flag_read, flag_important, flag_for_review)
				values('$notice_id', '$from_member_id', '$from_member_name', '$to_member_id', 'now()', 
								'$notice_subject', '$notice_text', 
								'$response_to_notice_id', '$to_section_id', '$sent_high_priority', 
								'$flag_read', '$flag_important', '$flag_for_review')";
							
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
			$notice_view->set_notice_id($notice_id);
		}

		mysqli_free_result($result);
		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	
	/***
	// updates the given key with the new value in the database
	($notice_id, $from_member_id, $to_member_id, $date_sent, $notice_subject, $notice_text, 
	$response_to_notice_id = null, $to_section_id = null, $sent_high_priority, 
	$flag_read, $flag_important, $flag_for_review)
	***/
	public function updateAttribute($notice_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$notice_id = $notice_view->get_notice_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'notice_id':
				return false;
				break;
			case 'from_member_id':
				$value = $notice_view->get_from_member_id();	
				$query = "update $table set from_member_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'from_member_name':
				$value = $notice_view->get_from_member_id();	
				$query = "update $table set from_member_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'to_member_id':
				$value = $notice_view->get_from_member_id();	
				$query = "update $table set from_member_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'date_sent':
				$value = $notice_view->get_date_sent();	
				$query = "update $table set date_sent = '$value' where notice_id = '$notice_id'";
				break;
			case 'notice_subject':
				$value = $notice_view->get_notice_subject();	
				$query = "update $table set notice_subject = '$value' where notice_id = '$notice_id'";
				break;
			case 'notice_text':
				$value = $notice_view->get_notice_text();	
				$query = "update $table set notice_text = '$value' where notice_id = '$notice_id'";
				break;
			case 'response_to_notice_id':
				$value = $notice_view->get_response_to_notice_id();	
				$query = "update $table set response_to_notice_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'to_section_id':
				$value = $notice_view->get_to_section_id();	
				$query = "update $table set to_section_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'sent_high_priority':
				$value = $notice_view->get_sent_high_priority();	
				$query = "update $table set sent_high_priority = '$value' where notice_id = '$notice_id'";
				break;
			case 'flag_read':
				$value = $notice_view->get_flag_read();	
				$query = "update $table set flag_read = '$value' where notice_id = '$notice_id'";
				break;
			case 'flag_important':
				$value = $notice_view->get_flag_important();	
				$query = "update $table set flag_important = '$value' where notice_id = '$notice_id'";
				break;
			case 'flag_for_review':
				$value = $notice_view->get_flag_for_review();	
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

	
	public function deleteFromDatabase($notice_view)
	{
		$db_connection = get_db_connection();
		$success = true;
		$notice_id = $notice_view->get_notice_id();
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