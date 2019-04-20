<?php



class Section_View_Controller extends DatabaseController {

	public function __construct(){}
	//($section_id, $section_name, $start_date, $end_date, 
	// $section_description, $professor_id, 
	// $professor_professor_first_name, $professor_professor_last_name, 
	// $school_name)
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_view = new Section_View();
				
				$section_view->initializeView($row['section_id'], $row['section_name'], 
										$row['start_date'], $row['end_date'], 
										$row['section_description'], 
										$row['professor_id'], $row['professor_first_name'], 
										$row['professor_last_name'], $row['school_name']);
										
				// pushes each object onto the end of the array
				$dataArray[] = $section_view;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}
	
	
	// updates the given key with the new value in the database
	public function updateAttribute($section_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section_view->get_section_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'section_id':
				return false;
				break;
			case 'section_name':
				$value = $section_view->get_section_name();	
				$query = "update $table set section_name = '$value' where section_id = '$section_id'";
				break;
			case 'start_date':
				$value = $section_view->get_start_date();	
				$query = "update $table set start_date = '$value' where section_id = '$section_id'";
				break;
			case 'end_date':
				$value = $section_view->get_end_date();	
				$query = "update $table set end_date = '$value' where section_id = '$section_id'";
				break;
			case 'section_description':
				$value = $section_view->get_section_description();	
				$query = "update $table set section_description = '$value' where section_id = '$section_id'";
				break;
			case 'professor_id':
				$value = $section_view->get_professor_id();	
				$query = "update $table set professor_id = '$value' where section_id = '$section_id'";
				break;
			case 'professor_first_name':
				$value = $section_view->get_professor_first_name();	
				$query = "update $table set professor_first_name = '$value' where section_id = '$section_id'";
				break;
			case 'professor_last_name':
				$value = $section_view->get_professor_last_name();	
				$query = "update $table set professor_last_name = '$value' where section_id = '$section_id'";
				break;
			case 'school_name':
				$value = $section_view->get_school_name();	
				$query = "update $table set school_name = '$value' where section_id = '$section_id'";
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
	public function updateAll($section_view)
	{
		return false;
	}
	
	
	// database view objects do new database entries
	// due to multiple tables being involved
	public function saveNew(&$section_view)
	{
		return false;
	}


	// database view objects do not delete objects from the database
	// due to multiple tables being involved
	public function deleteFromDatabase($section_view)
	{
		return false;
	}
	
	
}

?>