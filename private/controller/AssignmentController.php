<?php



class AssignmentController extends DatabaseController {

	public function __construct() {}
	//($assignment_id, $section_id, $lab_id, $tag, $date_assigned, $date_due, $points_possible, $notes)

	public function initialize()
	{
		$table = "assignment";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray)
	{
		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$assignment = new Assignment();
				$assignment->initialize($row['assignment_id'], $row['section_id'], $row['lab_id'], $row['tag'],  
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
	
	
	// The ids must not be changed, so they are not updated.
	public function update($assignment)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		
		$assignment_id = $assignment->get_assignment_id();
		$section_id = $assignment->get_section_id();
		$lab_id = $assignment->get_lab_id();
		$tag = $assignment->get_tag();
		$date_assigned = $assignment->get_date_assigned();
		$date_due = $assignment->get_date_due();
		$points_possible = $assignment->get_points_possible();
		$notes = $assignment->get_notes();
		
		// The ids must not be changed, so they are not updated.
		$query = "update assignment set section_id = '$section_id', lab_id = '$lab_id', tag = '$tag', 
					date_assigned = '$date_assigned', date_due = '$date_due', points_possible = '$points_possible', notes = '$notes' 
					where assignment_id = '$assignment_id'";
					
		$result = mysqli_query($db_connection, $query);

		if($result)
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The assignment could not be updated.</p>';
		}

		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;

	}

	
	// The assignment_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$assignment)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		
		$section_id = $assignment->get_section_id();
		$lab_id = $assignment->get_lab_id();
		$tag = $assignment->get_tag();
		$date_assigned = $assignment->get_date_assigned();
		$date_due = $assignment->get_date_due();
		$points_possible = $assignment->get_points_possible();
		$notes = $assignment->get_notes();
		
		// The assignment_id will be auto-generated.
		$query = "insert into assignment (section_id, tag, lab_id, date_assigned, date_due, points_possible, notes) 
			values ('$section_id', '$lab_id', '$tag', '$date_assigned', '$date_due', '$points_possible', '$notes')";
		
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


}

?>