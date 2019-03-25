<?php

/***
$assignment_id, $section_id, $tutorial_lab_id, $assignment_name, 
$date_assigned, $date_due, $points_possible, 
$section_name, $professor_id, $professor_first_name, $professor_last_name, $school_name,
$tutorial_lab_name, $tutorial_lab_introduction, $tutorial_lab_web_link
***/

class Assignment_View_Controller extends DatabaseController {

	public function __construct() {}


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$assignment_view = new Assignment_View();
				$assignment_view->initializeView($row['assignment_id'], $row['section_id'], 
						$row['tutorial_lab_id'],  $row['assignment_name'], $row['date_assigned'], 
						$row['date_due'], $row['points_possible'], 
						$row['section_name'], $row['professor_id'], 
						$row['professor_first_name'], $row['professor_last_name'], 
						$row['school_name'], 
						$row['tutorial_lab_name'], $row['tutorial_lab_introduction'], 
						$row['tutorial_lab_web_link']);
				// pushes each object onto the end of the array
				$dataArray[] = $assignment_view;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}
	
	
	/***
		updates the given key with the new value in the database 
	
		$assignment_id, $section_id, $tutorial_lab_id, $date_assigned, 
		$assignment_name, $date_due, $points_possible, 
		$section_name, $professor_id, $professor_first_name, $school_name,
		$tutorial_lab_name, $tutorial_lab_introduction, $tutorial_lab_web_link
	***/
	public function updateAttribute($assignment_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$assignment_id = $assignment_view->get_assignment_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'assignment_id':
				$value = $assignment_view->get_assignment_id();	
				$query = "update $table set assignment_id = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'section_id':
				$value = $assignment_view->get_section_id();	
				$query = "update $table set section_id = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'tutorial_lab_id':
				$value = $assignment_view->get_tutorial_lab_id();	
				$query = "update $table set tutorial_lab_id = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'assignment_name':
				$value = $assignment_view->get_assignment_name();	
				$query = "update $table set assignment_name = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'date_assigned':
				$value = $assignment_view->get_date_assigned();	
				$query = "update $table set date_assigned = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'date_due':
				$value = $assignment_view->get_date_due();	
				$query = "update $table set date_due = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'points_possible':
				$value = $assignment_view->get_points_possible();	
				$query = "update $table set points_possible = '$value' 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'section_name':
				$value = $assignment_view->get_section_name();	
				$query = "update $table set section_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'professor_id':
				$value = $assignment_view->get_professor_id();	
				$query = "update $table set professor_id = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'professor_first_name':
				$value = $assignment_view->get_professor_first_name();	
				$query = "update $table set professor_first_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'professor_last_name':
				$value = $assignment_view->get_professor_last_name();	
				$query = "update $table set professor_last_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'school_name':
				$value = $assignment_view->get_school_name();	
				$query = "update $table set school_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'tutorial_lab_name':
				$value = $assignment_view->get_tutorial_lab_name();	
				$query = "update $table set tutorial_lab_name = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'tutorial_lab_introduction':
				$value = $assignment_view->get_tutorial_lab_introduction();	
				$query = "update $table set tutorial_lab_introduction = '$value' where 
							where (assignment_id = '$assignment_id') AND (section_id = '$section_id')";
				break;
			case 'tutorial_lab_web_link':
				$value = $assignment_view->get_tutorial_lab_web_link();	
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

	
	// database view objects do not do full updates
	// due to multiple tables being involved
	public function updateAll($assignment_view)
	{
		return false;
	}
	
	
	// database view objects do new database entries
	// due to multiple tables being involved
	public function saveNew(&$assignment_view)
	{
		return false;
	}


	// database view objects do not delete objects from the database
	// due to multiple tables being involved
	public function deleteFromDatabase($assignment_view)
	{
		return false;
	}
	

}

?>