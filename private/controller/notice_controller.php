<?php


class Notice_controller extends DatabaseController {

	public function __construct() {}
	//($notice_id, $assignment_id, $notice_type, $date_sent, $notice_text)

	public function get_by_id($id_number, $id_type)
	{
		$notice_array = array();
		$notice_array[] = get_group_by_attribute($id_number, $id_type);
		return $notice_array;
	}
	
	
	public function get_by_attribute($attribute, $attribute_type)
	{
		$notice_array = array();
		$query = 'select * from notice where $attribute_type = $attribute';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$notice_array[] = new Notice($row['notice_id'], $row['assignment_id'], $row['date_sent'], $row['notice_text']);		
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $notice_array;
	}
	

	public function get_all()
	{
		$notice_array = array();
		$query = 'select * from notice';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$notice_array[] = new Notice($row['notice_id'], $row['assignment_id'], $row['date_sent'], $row['notice_text']);		
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $notice_array;

	}
	
	
	public function update($professor)
	{
		$sucess = true;
		
		// The notice_id should not be changed.
		$query = 'update notice set first_name = $notice->assignment_id, $notice->notice_type, now(), $notice->notice_text where notice_id = $notice->professor_id';
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The notice could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}
	
	public function save_new($notice)
	{
		$sucess = true;
		
		// The notice_id is not included, because it is set automatically by the database.
		$query = 'insert into notice (assignment_id, notice_type, date_sent, notice_text) 
				values($notice->assignment_id, $notice->notice_type, now(), $notice->notice_text)';
				
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$notice->notice_id = mysql_insert_id();
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New notice could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	
	
}

?>