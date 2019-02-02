<?php



class SectionStudentsController extends DatabaseController {

	
	public function __construct() {}
	//($section_id, $student_id)
	
	public function initialize()
	{
		$this->tableName = "section_students";
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_student = new Section_Students();
				$section_student->initialize($row['section_id'], $row['student_id']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_student;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	// The id for section_students is NOT auto-generated.
	public function saveNew(&$section_student)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$section_id = $section_student->get_section_id();
		$student_id = $section_student->get_student_id();
		
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
	
	
	// No update is available, because neither student id or professor id is unique.
	// Use delete and save new instead if a change is needed.
	public function update_attribute(&$section_student, $attribute, $value)
	{
		return false;		
	}


	public function delete_from_database($section_student)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$section_id = $section_student->get_section_id();
		$student_id = $section_student->get_student_id();
		
		$query = "delete from section_student where (section_id = $section_id) AND (student_id = $student_id)";
		
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