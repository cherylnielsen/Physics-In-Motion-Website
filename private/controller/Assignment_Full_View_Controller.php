<?php

/***
$assignment_id, $section_id, $tutorial_lab_id, $date_assigned, 
$assignment_name, $date_due, $points_possible, $notes,
$section_name, $professor_id, $professor_name, $school_name,
$tutorial_lab_name, $tutorial_lab_introduction, $tutorial_lab_web_link
***/

class AssignmentController extends DatabaseController {

	public function __construct() {}


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$assignment = new Assignment();
				$assignment->initialize($row['assignment_id'], $row['section_id'], $row['tutorial_lab_id'],  $row['date_assigned'], 
						$row['assignment_name'], $row['date_due'], $row['points_possible'], $row['notes'],
						$row['section_name'], $row['professor_id'], $row['professor_name'],  $row['school_name'], 
						$row['tutorial_lab_name'], $row['tutorial_lab_introduction'], $row['tutorial_lab_web_link']);
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
		$notes = $assignment->get_notes();
		$table = $this->getTableName();
		
		$section_name = $assignment->get_section_name();
		$professor_id = $assignment->get_professor_id();
		$professor_name = $assignment->get_professor_name();
		$school_name = $assignment->get_school_name();
		$tutorial_lab_name = $assignment->get_tutorial_lab_name();
		$tutorial_lab_introduction = $assignment->get_tutorial_lab_introduction();
		$tutorial_lab_web_link = $assignment->get_tutorial_lab_web_link();
		
		// The assignment_id will be auto-generated.
		$query = "insert into $table (assignment_id, section_id, tutorial_lab_id, date_assigned, 
									assignment_name, date_due, points_possible, notes,
									section_name, professor_id, professor_name, school_name,
									tutorial_lab_name, tutorial_lab_introduction, tutorial_lab_web_link) 
			values ('$assignment_id', '$section_id', '$tutorial_lab_id', '$date_assigned', 
						'$assignment_name', '$date_due', '$points_possible', '$notes',
						'$section_name', '$professor_id', '$professor_name', '$school_name',
						'$tutorial_lab_name', '$tutorial_lab_introduction', '$tutorial_lab_web_link')";
		
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


	
	/***
		updates the given key with the new value in the database 
	
		$assignment_id, $section_id, $tutorial_lab_id, $date_assigned, 
		$assignment_name, $date_due, $points_possible, $notes,
		$section_name, $professor_id, $professor_name, $school_name,
		$tutorial_lab_name, $tutorial_lab_introduction, $tutorial_lab_web_link
	***/
	public function updateAttribute($assignment, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$assignment_id = $assignment->get_assignment_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'assignment_id':
				$value = $assignment->get_assignment_id();	
				$query = "update $table set assignment_id = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'section_id':
				$value = $assignment->get_section_id();	
				$query = "update $table set section_id = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
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
			case 'notes':
				$value = $assignment->get_notes();	
				$query = "update $table set notes = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'section_name':
				$value = $assignment->get_section_name();	
				$query = "update $table set section_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'professor_id':
				$value = $assignment->get_professor_id();	
				$query = "update $table set professor_id = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'professor_name':
				$value = $assignment->get_professor_name();	
				$query = "update $table set professor_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'school_name':
				$value = $assignment->get_school_name();	
				$query = "update $table set school_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'tutorial_lab_name':
				$value = $assignment->get_tutorial_lab_name();	
				$query = "update $table set tutorial_lab_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'tutorial_lab_introduction':
				$value = $assignment->get_tutorial_lab_introduction();	
				$query = "update $table set tutorial_lab_introduction = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'tutorial_lab_web_link':
				$value = $assignment->get_tutorial_lab_web_link();	
				$query = "update $table set tutorial_lab_web_link = '$value' where 
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

	
	public function deleteFromDatabase($assignment)
	{
		$db_connection = get_db_connection();
		$success = true;
		$assignment_id = $assignment->get_assignment_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
		
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