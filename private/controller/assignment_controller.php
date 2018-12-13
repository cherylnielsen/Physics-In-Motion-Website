<?php


class Assignment_controller extends DatabaseController {

	public function __construct() {}
	//($assignment_id, $professor_id, $student_id, $lab_id, $date_assigne, $date_due, $date_submited, $total_time, $added_instructions)


	public function get_by_attribute($attribute_value, $attribute_type, $db_connection)
	{
		$assignment_array = array();
		$query = "select * from assignment where $attribute_type = '$attribute_value'";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$assignment = new Assignment();
				$assignment->initialize($row['assignment_id'], $row['professor_id'], $row['student_id'], $row['lab_id'], $row['date_assigned'], $row['date_due'], 
				$row['date_submited'], $row['total_time'], $row['added_instructions']);
				// pushes each object onto the end of the array
				$assignment_array[] = $assignment;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $assignment_array;
	}
	

	public function get_all($db_connection)
	{
		$assignment_array = array();
		$query = 'select * from assignment';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$assignment = new Assignment();
				$assignment->initialize($row['assignment_id'], $row['professor_id'], $row['student_id'], $row['lab_id'], $row['date_assigned'], $row['date_due'], 
				$row['date_submited'], $row['total_time'], $row['added_instructions']);
				// pushes each object onto the end of the array
				$assignment_array[] = $assignment;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $assignment_array;

	}
	
	public function update($assignment, $db_connection)
	{
		$sucess = true;
		// The assignment_id should not be changed.
		$query = 'update assignment set professor_id = $assignment->professor_id, student_id = $assignment->student_id, lab_id = $assignment->lab_id, date_assigned = $assignment->date_assigned, date_due = $assignment->date_due, date_submited = $assignment->date_submited, total_time = $assignment->total_time, added_instructions = $assignment->added_instructions
					where assignment_id = $assignment_id';
					
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The assignment could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function save_new($assignment, $db_connection)
	{
		$sucess = true;
		// The assignment_id is not included, because it is set automatically by the database.
		$query = 'insert into assignment (professor_id, student_id, lab_id, date_assigned, date_due, date_submited, total_time) values (professor_id = $assignment->professor_id, student_id = $assignment->student_id, lab_id = $assignment->lab_id, date_assigned = $assignment->date_assigned, date_due = $assignment->date_due, date_submited = $assignment->date_submited, total_time = $assignment->total_time, added_instructions = $assignment->added_instructions)';
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$assignment->set_assignment_id(mysql_insert_id());
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New assignment could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;		
	}


}

?>