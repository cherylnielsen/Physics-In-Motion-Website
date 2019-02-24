<?php



class Section_Student_View_Controller extends DatabaseController {

	public function __construct(){}
	//($section_id, $section_name, $start_date, $end_date, $student_id, $first_name, $last_name, $school_name)
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_student_view = new Section_Student_View();
				$section_student_view->initialize($row['section_id'], $row['section_name'], $row['start_date'], $row['end_date'], 
										$row['student_id'], $row['first_name'], $row['last_name'], $row['school_name']);
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
		$sucess = true;
		$db_connection = get_db_connection();
		$section_name = $section_student_view->get_section_name();
		$text = $section_student_view->get_start_date();
		$end_date = $section_student_view->get_end_date();
		$student_id = $section_student_view->get_student_id();
		$first_name = $section_student_view->get_first_name();
		$last_name = $section_student_view->get_last_name();
		$school_name = $section_student_view->get_school_name();
		$table = $this->getTableName();
		
		// The id will be auto-generated, when the new object is added to the database table.
		$query = "insert into $table (section_name, start_date, end_date, student_id, first_name, last_name, school_name) 
				values('$section_name', '$text', '$end_date', '$student_id', '$first_name', '$last_name', '$school_name')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$section_id = mysql_insert_id($db_connection);
			$section_student_view->set_section_id(section_id);				
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
			case 'first_name':
				$value = $section_student_view->get_first_name();	
				$query = "update $table set first_name = '$value' where section_id = '$section_id'";
				break;
			case 'last_name':
				$value = $section_student_view->get_last_name();	
				$query = "update $table set last_name = '$value' where section_id = '$section_id'";
				break;
			case 'school_name':
				$value = $section_student_view->get_school_name();	
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
 

	public function deleteFromDatabase($section_student_view)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section_student_view->get_section_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where section_id = $section_id";
		
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