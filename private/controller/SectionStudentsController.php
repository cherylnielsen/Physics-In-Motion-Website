<?php



class SectionStudentsController extends DatabaseController {

	
	public function __construct() {}
	//($section_id, $student_id)
	
	public function initialize()
	{
		$table = "section_students";
		$this->setTableName($table);
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_students = new Section_Students();
				$section_students->initialize($row['section_id'], $row['student_id']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_students;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	// The id for section_students is NOT auto-generated.
	public function saveNew(&$section_students)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$section_id = $section_students->get_section_id();
		$student_id = $section_students->get_student_id();
		
		$query = "insert into section_students (section_id, student_id) 
				values('$section_id', '$student_id')";
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
	
	
	public function update($section_students)
	{
		$sucess = false;		
		return $sucess;
	}


}

?>