<?php

require_once('../database-access.php');
require_once('../model/notice.php');

class notice_controller {

	public function notice_controller() {}


	public function get_by_assignment_id($assignment_id)
	{
		$notice_array = array();
		$query = 'select * from notice where assignment_id = $assignment_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$notice_array[] = new notice($row['notice_id'], $row['assignment_id'], $row['notice_type'], $row['date_sent'], $row['notice_text']);
				
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
	
	
	public function get_by_student_id($student_id)
	{
		$notice_array = array();
		
		$query = 'select * from notice where assignment_id in 
					(select assignment_id from assignment where student_id = $student_id);';
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$notice_array[] = new notice($row['notice_id'], $row['assignment_id'], $row['notice_type'], $row['date_sent'], $row['notice_text']);
				
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


	public function save_new_notice($assignment_id, $notice_type, $notice_text)
	{
		$sucess = true;
		// The notice_id is not included, because it is set automatically by the database.
		$query = 'insert into notice (assignment_id, notice_type, date_sent, notice_text) 
				values($assignment_id, $notice_type, now(), $notice_text)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
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
	
	
	public function delete_old_notice($notice_id)
	{
		$sucess = true;
		// The notice_id is not included, because it is set automatically by the database.
		$query = 'delete * from notice where notice_id = $notice_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>Notice could not be deleted.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>