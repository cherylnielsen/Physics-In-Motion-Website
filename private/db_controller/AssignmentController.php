<?php



class AssignmentController extends DatabaseController {

	
	public function __construct() {}
	// ($assignment_id, $section_id, $tutorial_lab_id, $assignment_name, $date_assigned, 
	//  $date_due, $points_possible)


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$assignment = new Assignment();
				$assignment->initialize($row['assignment_id'], $row['section_id'], 
						$row['tutorial_lab_id'],   
						$row['assignment_name'], $row['date_assigned'], $row['date_due'], 
						$row['points_possible']);
				// pushes each object onto the end of the array
				$dataArray[] = $assignment;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}
	

	// The assignment_id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$assignment)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		
		$section_id = $assignment->get_section_id();
		$tutorial_lab_id = $assignment->get_tutorial_lab_id();
		$assignment_name = $assignment->get_assignment_name();
		$date_assigned = $assignment->get_date_assigned();
		$date_due = $assignment->get_date_due();
		$points_possible = $assignment->get_points_possible();
		$table = $this->getTableName();
		
		// The assignment_id will be auto-generated.
		$query = "insert into $table (section_id, tutorial_lab_id, assignment_name, date_assigned, date_due, points_possible) 
			values ('$section_id', '$tutorial_lab_id', '$assignment_name', '$date_assigned', '$date_due', '$points_possible')";
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated assignment_id
			$assignment->set_assignment_id(mysqli_insert_id($db_connection));		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $sucess;		
	}


	// updates the given key with the new value in the database 
	//($assignment_id, $section_id, $tutorial_lab_id, $assignment_name, $date_assigned, $date_due, $points_possible)
	public function updateAttribute($assignment, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$assignment_id = $assignment->get_assignment_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'assignment_id':
			case 'section_id':
				return false;
				break;
			case 'tutorial_lab_id':
				$value = $assignment->get_tutorial_lab_id();	
				$query = "update $table set tutorial_lab_id = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'assignment_name':
				$value = $assignment->get_assignment_name();	
				$query = "update $table set assignment_name = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'date_assigned':
				$value = $assignment->get_date_assigned();	
				$query = "update $table set date_assigned = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'date_due':
				$value = $assignment->get_date_due();	
				$query = "update $table set date_due = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'points_possible':
				$value = $assignment->get_points_possible();	
				$query = "update $table set points_possible = '$value' 
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

	
	public function updateAll($assignment)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$assignment_id = $assignment->get_assignment_id();
		$section_id = $assignment->get_section_id();
		
		// data to be updated			
		$tutorial_lab_id = $assignment->get_tutorial_lab_id();
		$assignment_name = $assignment->get_assignment_name();
		$date_assigned = $assignment->get_date_assigned();
		$date_due = $assignment->get_date_due();
		$points_possible = $assignment->get_points_possible();
		
			
		$query = "UPDATE $table 
					SET tutorial_lab_id = '$tutorial_lab_id',
						assignment_name = '$assignment_name',
						date_assigned = '$date_assigned',
						date_due = '$date_due',
						points_possible = '$points_possible'
					WHERE (assignment_id = '$assignment_id') 
						AND (section_id = '$section_id')";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
	}
	
	
	public function deleteFromDatabase($assignment)
	{
		$db_connection = get_db_connection();
		$success = true;
		$assignment_id = $assignment->get_assignment_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where (assignment_id = $assignment_id)";
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