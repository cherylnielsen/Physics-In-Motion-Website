<?php



class SectionController extends DatabaseController {

	public function __construct(){}
	//($section_id, $professor_id, $section_name, $start_date, $end_date, $section_description)
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section = new Section();
				$section->initialize($row['section_id'], $row['section_name'], 
							$row['professor_id'], 
							$row['start_date'], $row['end_date'],
							$row['section_description']);
				// pushes each object onto the end of the array
				$dataArray[] = $section;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$section)
	{
		$success = true;
		$db_connection = get_db_connection();
		$section_name = $section->get_section_name();
		$professor_id = $section->get_professor_id();
		$text = $section->get_start_date();
		$start_date = $section->get_start_date();
		$end_date = $section->get_end_date();
		$section_description = $section->get_section_description();
		$table = $this->getTableName();
		
		// The id will be auto-generated, when the new object is added to the database table.
		$query = "insert into $table (section_name, professor_id, 
					start_date, end_date, section_description) 
						values('$section_name', '$professor_id', '$start_date', 
							'$end_date', '$section_description')";
					
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$section_id = mysqli_insert_id($db_connection);
			$section->set_section_id($section_id);				
		}
		else
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
		
	}
	
	
	// updates the given key with the new value in the database
	//($section_id, $section_name, $start_date, $end_date)
	public function updateAttribute($section, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section->get_section_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'section_id':
				return false;
				break;
			case 'section_name':
				$value = $section->get_section_name();	
				$query = "update $table set section_name = '$value' where section_id = '$section_id'";
				break;
			case 'professor_id':
				$value = $section->get_professor_id();	
				$query = "update $table set professor_id = '$value' where section_id = '$section_id'";
				break;
			case 'start_date':
				$value = $section->get_start_date();	
				$query = "update $table set start_date = '$value' where section_id = '$section_id'";
				break;
			case 'end_date':
				$value = $section->get_end_date();	
				$query = "update $table set end_date = '$value' where section_id = '$section_id'";
				break;
			case 'section_description':
				$value = $section->get_section_description();	
				$query = "update $table set section_description = '$value' where section_id = '$section_id'";
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
 

	public function updateAll($section)
	{
		$success = true;
		$db_connection = get_db_connection();
		$table = $this->getTableName();
		$section_id = $section->get_section_id();	
				
		// data to be updated			
		$section_name = $section->get_section_name();
		$professor_id = $section->get_professor_id();
		$start_date = $section->get_start_date();
		$end_date = $section->get_end_date();
		$section_description = $section->get_section_description();
					
		$query = "UPDATE $table 
					SET section_name = '$section_name',
						professor_id = '$professor_id',
						start_date = '$start_date',
						end_date = '$end_date',
						section_description = '$section_description'
					WHERE section_id = '$section_id'";
						
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;
	}
	
	
	public function deleteFromDatabase($section)
	{
		$db_connection = get_db_connection();
		$success = true;
		$section_id = $section->get_section_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where section_id = $section_id";
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