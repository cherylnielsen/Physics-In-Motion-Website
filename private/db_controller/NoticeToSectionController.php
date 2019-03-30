<?php


class NoticeToSectionController extends DatabaseController {

  	
	public function __construct() {}
	//($notice_id, $to_section_id)
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$notice_to_section = new NoticeToSection();
				$notice_to_section->initialize($row['notice_id'], $row['to_section_id']);
				// pushes each object onto the end of the array
				$dataArray[] = $notice_to_section;	
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}
	
	
	public function saveNew(&$notice_to_section)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$notice_id = $notice_to_section->get_notice_id();
		$to_section_id = $notice_to_section->get_to_section_id();
		$table = $this->getTableName();
		
		$query = "insert into $table (notice_id, to_section_id) 
				values('$notice_id', '$to_section_id')";
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
	// NOTHING to update, both items in the table form the joint primary key for each row
	// ($notice_id, $to_section_id)
	public function updateAttribute($notice_to_section, $key)
	{
		return false;		
	}
	
	
	// NOTHING to update, both items in the table form the joint primary key for each row
	// ($notice_id, $to_section_id)
	public function updateAll($notice_to_section)
	{
		return false;		
	}

	
	public function deleteFromDatabase($notice_to_section)
	{
		$db_connection = get_db_connection();
		$success = true;
		$notice_id = $notice_to_section->get_notice_id();
		$to_section_id = $notice_to_section->get_to_section_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where where (notice_id = '$notice_id') AND (to_section_id = '$to_section_id')";
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