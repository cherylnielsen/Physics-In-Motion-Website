<?php

class Homework_controller extends DatabaseController {

	public function __construct() {}
	//($homework_id, $assignment_id, $lab_summary, $lab_data, $lab_graphs, $lab_math, $lab_errors, $chat_session, $lab_report)


	public function get_by_id($id_number, $id_type)
	{
		$homework_array = array();
		$homework_array[] = get_group_by_attribute($id_number, $id_type);
		return $homework_array;
	}
	
	public function get_by_attribute($attribute, $attribute_type)
	{
		$homework_array = array();
		$query = 'select * from homework where $attribute_type = $attribute';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$homework_array[] = new Homework($row['homework_id'], $row['assignment_id'], $row['lab_summary'], $row['lab_data'], $row['lab_graphs'], $row['lab_math'], $row['lab_errors'], $row['chat_session'], $row['lab_report']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $homework_array;
	}
	

	public function get_all()
	{
		$homework_array = array();
		$query = 'select * from homework';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				// pushes each object onto the end of the array
				$homework_array[] = new Homework($row['homework_id'], $row['assignment_id'], $row['lab_summary'], $row['lab_data'], $row['lab_graphs'], $row['lab_math'], $row['lab_errors'], $row['chat_session'], $row['lab_report']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $homework_array;

	}
	
	
	public function update($homework)
	{
		$sucess = true;
		
		// The homework_id and assignment_id should not be changed.
		$query = 'update homework set assignment_id = $homework->$assignment_id, lab_summary = $homework->lab_summary, lab_data = $homework->lab_data, lab_graphs = $homework->lab_graphs, lab_math = $homework->lab_math, lab_errors = $homework->lab_errors, chat_session = $homework->chat_session, lab_report = $homework->lab_report
		where homework_id = $homework_id';
					
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The homework could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}
	
	
	public function save_new($homework)
	{
		$sucess = true;
		
		// The homework_id is not included, because it is set automatically by the database.
		$query = 'insert into homework (assignment_id, lab_summary, lab_data, lab_graphs, lab_math, lab_errors, chat_session, lab_report) 
		values ($homework->assignment_id, $homework->lab_summary, $homework->lab_data, $homework->lab_graphs, $homework->lab_math, $homework->lab_errors, $homework->chat_session, $homework->lab_report)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$homework->homework_id = mysql_insert_id();
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New homework could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	

}

?>