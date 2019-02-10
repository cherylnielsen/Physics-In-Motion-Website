<?php



class SectionController extends DatabaseController {

	
	public function __construct() 
	{
		$this->tableName = "section";
	}
	//($section_id, $professor_id, $section_name, $start_date, $end_date)
	

	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section = new Section();
				$section->initialize($row['section_id'], $row['section_name'], $row['professor_id'], 
							$row['start_date'], $row['end_date']);
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
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$section_name = $section->get_section_name();
		$professor_id = $section->get_professor_id();
		$text = $section->get_start_date();
		$end_date = $section->get_end_date();
		
		// The id will be auto-generated, when the new object is added to the database table.
		$query = "insert into section (section_name, professor_id, start_date, end_date) 
				values('$section_name', '$professor_id', '$text', '$end_date')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$section_id = mysql_insert_id($db_connection);
			$section->set_section_id(section_id);				
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
	
	
	// updates the given attribute with the new value in the database and in the section object
	//($section_id, $section_name, $start_date, $end_date)
	public function updateAttribute(&$section, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$section_id = $section->get_section_id();	
		
		switch ($attribute)
		{
			case 'section_id':
				return false;
				break;
			case 'section_name':
				$section->set_section_name($value);	
				$query = "update section set section_name = '$value' where section_id = '$section_id'";
				break;
			case 'professor_id':
				$section->set_professor_id($value);	
				$query = "update section set professor_id = '$value' where section_id = '$section_id'";
				break;
			case 'start_date':
				$section->set_start_date($value);	
				$query = "update section set start_date = '$value' where section_id = '$section_id'";
				break;
			case 'end_date':
				$section->set_end_date($value);	
				$query = "update section set end_date = '$value' where section_id = '$section_id'";
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
 

	public function delete_from_database($section)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$section_id = $section->get_section_id();
		
		$query = "delete from section where section_id = $section_id";
		
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