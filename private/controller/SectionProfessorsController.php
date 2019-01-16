<?php



class SectionProfessorsController extends DatabaseController {

	
	public function __construct() {}
	//($section_id, $professor_id)
	
	public function initialize()
	{
		$table = "section_professors";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_professors = new Section_Professors();
				$section_professors->initialize($row['section_id'], $row['professor_id']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_professors;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	// The id for section_professors is NOT auto-generated.
	public function saveNew(&$section_professors)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$section_id = $section_professors->get_section_id();
		$professor_id = $section_professors->get_professor_id();
		
		$query = "insert into section_professors (section_id, professor_id) 
				values('$section_id', '$professor_id')";
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
	
	
	public function update($section_professors)
	{
		$sucess = false;		
		return $sucess;
	}


}

?>