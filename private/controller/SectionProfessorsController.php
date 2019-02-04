<?php



class SectionProfessorsController extends DatabaseController {

	
	public function __construct() {}
	//($section_id, $user_id)
	
	public function initialize()
	{
		$this->tableName = "section_professors";
	}

	protected function getData($db_result, &$dataArray, $db_connection)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$section_professor = new Section_Professors();
				$section_professor->initialize($row['section_id'], $row['user_id']);
				// pushes each object onto the end of the array
				$dataArray[] = $section_professor;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
	}


	// The id for section_professors is NOT auto-generated.
	public function saveNew(&$section_professor)
	{
		$sucess = true;
		$db_connection = $this->get_db_connection();
		$section_id = $section_professor->get_section_id();
		$user_id = $section_professor->get_user_id();
		
		$query = "insert into section_professors (section_id, user_id) 
				values('$section_id', '$user_id')";
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
	
	
	// No update is available, because neither professor id or professor id is unique.
	// Use delete and save new instead if a change is needed.
	public function update_attribute(&$section_professor, $attribute, $value)
	{
		return false;		
	}


	public function delete_from_database($section_professor)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$section_id = $section_professor->get_section_id();
		$user_id = $section_professor->get_user_id();
		
		$query = "delete from section_professor where (section_id = $section_id) AND (user_id = $user_id)";
		
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