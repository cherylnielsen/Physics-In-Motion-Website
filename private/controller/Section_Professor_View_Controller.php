<?php



class Section_Professor_View_Controller extends DatabaseController {

	public function __construct(){}
	//($section_id, $section_name, $start_date, $end_date, $professor_id, $professor_name, $school_name)
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_professor_view = new Section_Professor_View();
				$section_professor_view->initialize($row['section_id'], $row['section_name'], $row['start_date'], $row['end_date'], 
										$row['professor_id'], $row['professor_name'], $row['school_name']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_professor_view;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$section_professor_view)
	{
		$sucess = true;
		$db_connection = get_db_connection();
		$section_name = $section_professor_view->get_section_name();
		$text = $section_professor_view->get_start_date();
		$end_date = $section_professor_view->get_end_date();
		$professor_id = $section_professor_view->get_professor_id();
		$professor_name = $section_professor_view->get_professor_name();
		$school_name = $section_professor_view->get_school_name();
		$table = $this->getTableName();
		
		// The id will be auto-generated, when the new object is added to the database table.
		$query = "insert into $table (section_name, start_date, end_date, professor_id, professor_name, school_name) 
				values('$section_name', '$text', '$end_date', '$professor_id', '$professor_name', '$school_name')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$section_id = mysql_insert_id($db_connection);
			$section_professor_view->set_section_id(section_id);				
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
	public function updateAttribute($section_professor_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section_professor_view->get_section_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'section_id':
				return false;
				break;
			case 'section_name':
				$value = $section_professor_view->get_section_name();	
				$query = "update $table set section_name = '$value' where section_id = '$section_id'";
				break;
			case 'start_date':
				$value = $section_professor_view->get_start_date();	
				$query = "update $table set start_date = '$value' where section_id = '$section_id'";
				break;
			case 'end_date':
				$value = $section_professor_view->get_end_date();	
				$query = "update $table set end_date = '$value' where section_id = '$section_id'";
				break;
			case 'professor_id':
				$value = $section_professor_view->get_professor_id();	
				$query = "update $table set professor_id = '$value' where section_id = '$section_id'";
				break;
			case 'professor_name':
				$value = $section_professor_view->get_professor_name();	
				$query = "update $table set professor_name = '$value' where section_id = '$section_id'";
				break;
			case 'school_name':
				$value = $section_professor_view->get_school_name();	
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
 

	public function deleteFromDatabase($section_professor_view)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section_professor_view->get_section_id();
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