<?php



class Section_List_Of_Students_View_Controller extends DatabaseController {

	public function __construct(){}
	// ($section_id, $section_name, $start_date, $end_date,
	//   $student_id, $first_name, $last_name, $school_name,
	//   $dropped_section, $reviewed_section)
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_student_view = new Section_List_Of_Students_View();
				$section_student_view->initialize($row['section_id'], $row['section_name'], 
										$row['start_date'], $row['end_date'], 
										$row['student_id'], $row['student_first_name'], 
										$row['student_last_name'], $row['school_name'], 
										$row['dropped_section'], $row['reviewed_section']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_student_view;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$section_student_view)
	{
		return false;
	}
	
	
	// updates the given key with the new value in the database
	//($section_id, $section_name, $start_date, $end_date)
	public function updateAttribute($section_student_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section_student_view->get_section_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'section_id':
				return false;
				break;
			case 'section_name':
				$value = $section_student_view->get_section_name();	
				$query = "update $table set section_name = '$value' where section_id = '$section_id'";
				break;
			case 'start_date':
				$value = $section_student_view->get_start_date();	
				$query = "update $table set start_date = '$value' where section_id = '$section_id'";
				break;
			case 'end_date':
				$value = $section_student_view->get_end_date();	
				$query = "update $table set end_date = '$value' where section_id = '$section_id'";
				break;
			case 'student_id':
				$value = $section_student_view->get_student_id();	
				$query = "update $table set student_id = '$value' where section_id = '$section_id'";
				break;
			case 'student_first_name':
				$value = $section_student_view->get_student_first_name();	
				$query = "update $table set student_first_name = '$value' where section_id = '$section_id'";
				break;
			case 'student_last_name':
				$value = $section_student_view->get_student_last_name();	
				$query = "update $table set student_last_name = '$value' where section_id = '$section_id'";
				break;
			case 'school_name':
				$value = $section_student_view->get_school_name();	
				$query = "update $table set school_name = '$value' where section_id = '$section_id'";
				break;
			case 'dropped_section':
				$value = $section_student_view->get_dropped_section();	
				$query = "update $table set dropped_section = '$value' where section_id = '$section_id'";
				break;
			case 'reviewed_section':
				$value = $section_student_view->get_reviewed_section();	
				$query = "update $table set reviewed_section = '$value' where section_id = '$section_id'";
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
 

	public function deleteFromDatabase($section_student_view)
	{
		return false;
	}

}

?>