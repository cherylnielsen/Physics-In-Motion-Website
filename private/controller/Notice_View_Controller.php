<?php

/***
( $notice_id, $response_to_notice_id, $date_sent, $notice_subject, $notice_text, 
$from_member_id, $from_first_name, $from_last_name, $from_member_type, 
$to_member_id, $to_section_id, $flag_for_review )
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
				
				$notice_view->initialize($row['notice_id'], $row['from_member_id'], 
					$row['date_sent'], $row['notice_subject'], $row['notice_text'], 
					$row['from_first_name'], $row['from_last_name'], 
					$row['from_member_type'],  
					$row['response_to_notice_id'], $row['flag_for_review']);
					
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
		return false;
	}
	
	
	
	/***
	// updates the given key with the new value in the database
	($notice_id, $from_member_id, $to_member_id, $date_sent, $notice_subject, $notice_text, 
	$response_to_notice_id = null, $to_section_id = null, $flag_for_review)
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
			case 'from_member_id':
				$value = $notice_view->get_from_member_id();	
				$query = "update $table set from_member_id = '$value' where notice_id = '$notice_id'";
				break;
			case 'from_first_name':
				$value = $notice_view->get_from_first_name();	
				$query = "update $table set from_first_name = '$value' where notice_id = '$notice_id'";
				break;
			case 'from_last_name':
				$value = $notice_view->get_from_last_name();	
				$query = "update $table set from_last_name = '$value' where notice_id = '$notice_id'";
				break;
			case 'from_member_type':
				$value = $notice_view->get_from_member_type();	
				$query = "update $table set from_member_type = '$value' where notice_id = '$notice_id'";
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
		return false;
	}
	
	
	
}


?>