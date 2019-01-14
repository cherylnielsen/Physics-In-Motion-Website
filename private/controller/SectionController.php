<?php

require_once('model/Section.php');
require_once('controller/DatabaseController.php');

class SectionController extends DatabaseController {

	
	public function __construct() {}
	//($section_id, $section_name, $start_date, $end_date)
	
	public function initialize()
	{
		$table = "section";
		$this->setTableName($table);
	}

	private function getData($db_result, &$dataArray)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section = new Section();
				$section->initialize($row['section_id'], $row['section_name'], $row['start_date'], $row['end_date']);
				// pushes each object onto the end of the array
				$dataArray[] = $section;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$section)
	{
		$sucess = true;
		$db_connection = $this->$get_db_connection();
		$section_name = $section->get_section_name();
		$text = $section->get_start_date();
		$end_date = $section->get_end_date();
		
		// The id will be auto-generated, when the new object is added to the database table.
		$query = "insert into section (section_name, start_date, end_date) 
				values('$section_name', '$text', '$end_date')";
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
	

	// The id must not be changed, so it is not updated.
	public function update(&$section)
	{
		$sucess = true;
		$db_connection = $this->$get_db_connection();
		$section_id = $section->get_section_id();
		$section_name = $section->get_section_name();
		$text = $section->get_start_date();
		$end_date = $section->get_end_date();
		
		
		// The id must not be changed, so it is not updated.
		$query = "update section set end_date_posted = '$end_date', section_name = '$section_name', 
					start_date = '$text' where section_id = '$section_id'";
				
		$result = mysqli_query($db_connection, $query);

		if($result)
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