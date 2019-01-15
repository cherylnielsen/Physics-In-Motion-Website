<?php



class TutorialLabController extends DatabaseController {

	public function __construct() {}
	//($lab_id, $lab_name, $lab_status, $introduction, $prerequisites, $key_topics, 
	// $key_equations, $description, $instructions, $date_first_available)
	
	public function initialize()
	{
		$table = "tutorial_lab";
		$this->setTableName($table);
	}

	
	protected function getData($db_result, &$dataArray)
	{
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$lab = new TutorialLab();
				$lab->initialize($row['lab_id'], $row['lab_name'], $row['lab_status'], $row['introduction'], 
							$row['prerequisites'], $row['key_topics'], $row['key_equations'], $row['description'], 
							$row['instructions'], $row['date_first_available']);
				$dataArray[] = $lab;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
	}	
	
	
	// The id must not be changed, so it is not updated.
	public function update($tutorial_lab)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$lab_id = $tutorial_lab->get_lab_id();
		$lab_name = $tutorial_lab->get_lab_name();
		$lab_status = $tutorial_lab->get_lab_status();
		$introduction = $tutorial_lab->get_introduction();
		$prerequisites = $tutorial_lab->get_prerequisites();
		$key_topics = $tutorial_lab->get_key_topics();
		$key_equations = $tutorial_lab->get_key_equations();
		$description = $tutorial_lab->get_description();
		$instructions = $tutorial_lab->get_instructions();
		$date_first_available = $tutorial_lab->get_date_first_available();
		
		// The id must not be changed, so it is not updated.
		$query = "update tutorial_lab set lab_name = '$lab_name', lab_status = '$lab_status', 
				introduction = '$introduction', prerequisites = '$prerequisites', key_topics = '$key_topics', 
				key_equations = '$key_equations', description = '$description', instructions = '$instructions', 
				date_first_available = '$date_first_available' 
				where lab_id = '$lab_id'";
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The tutorial_lab could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$tutorial_lab)
	{
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$lab_name = $tutorial_lab->get_lab_name();
		$lab_status = $tutorial_lab->get_lab_status();
		$introduction = $tutorial_lab->get_introduction();
		$prerequisites = $tutorial_lab->get_prerequisites();
		$key_topics = $tutorial_lab->get_key_topics();
		$key_equations = $tutorial_lab->get_key_equations();
		$description = $tutorial_lab->get_description();
		$instructions = $tutorial_lab->get_instructions();
		$date_first_available = $tutorial_lab->get_date_first_available();
		
		// The id will be auto-generated
		$query = "insert into tutorial_lab (lab_name, lab_status, introduction, prerequisites, 
				key_topics, key_equations, description, instructions, date_first_available) 
		values ('$lab_name', '$lab_status', '$introduction', '$prerequisites', '$key_topics', 
				'$key_equations', '$description', '$instructions', '$date_first_available')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$lab_id = mysql_insert_id($db_connection);
			$tutorial_lab->set_lab_id($lab_id);	
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


}

?>