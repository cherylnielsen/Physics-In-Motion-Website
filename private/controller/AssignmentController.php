<?php



class AssignmentController extends DatabaseController {

	
	public function __construct() 
	{
		$this->tableName = "assignment";
	}
	//($assignment_id, $section_id, $lab_id, $date_assigned, $date_due, $points_possible, $notes)


	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$assignment = new Assignment();
				$assignment->initialize($row['assignment_id'], $row['section_id'], $row['lab_id'],   
						$row['date_assigned'], $row['date_due'], $row['points_possible'], $row['notes']);
				// pushes each object onto the end of the array
				$dataArray[] = $assignment;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}
	

	// The assignment_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$assignment)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		
		$section_id = $assignment->get_section_id();
		$lab_id = $assignment->get_lab_id();
		$date_assigned = $assignment->get_date_assigned();
		$date_due = $assignment->get_date_due();
		$points_possible = $assignment->get_points_possible();
		$notes = $assignment->get_notes();
		
		// The assignment_id will be auto-generated.
		$query = "insert into assignment (section_id, lab_id, date_assigned, date_due, points_possible, notes) 
			values ('$section_id', '$lab_id', '$date_assigned', '$date_due', '$points_possible', '$notes')";
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated assignment_id
			$assignment->set_assignment_id(mysql_insert_id($db_connection));		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;		
	}


	// updates the given attribute with the new value in the database and in the assignment object
	//($assignment_id, $section_id, $lab_id, $tag, $date_assigned, $date_due, $points_possible, $notes)
	public function update_attribute(&$assignment, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$assignment_id = $assignment->get_assignment_id();	
		
		switch ($attribute)
		{
			case 'assignment_id':
			case 'section_id':
				return false;
				break;
			case 'lab_id':
				$assignment->set_lab_id($value);	
				$query = "update assignment set lab_id = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'date_assigned':
				$assignment->set_date_assigned($value);	
				$query = "update assignment set date_assigned = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'date_due':
				$assignment->set_date_due($value);	
				$query = "update assignment set date_due = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'points_possible':
				$assignment->set_points_possible($value);	
				$query = "update assignment set points_possible = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'notes':
				$assignment->set_notes($value);	
				$query = "update assignment set notes = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
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

	
	public function delete_from_database($assignment)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$assignment_id = $assignment->get_assignment_id();
		
		$query = "delete from assignment where assignment_id = $assignment_id";
		
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