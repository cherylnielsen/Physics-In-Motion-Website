<?php



class TutorialLabController extends DatabaseController {
	
	
	public function __construct() {}
	// $tutorial_lab_id, $tutorial_lab_name, $tutorial_lab_web_link, $lab_status, 
	// $tutorial_lab_introduction, $prerequisites, $key_topics, 
	// $key_equations, $description, $instructions, $date_first_available)

	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$lab = new Tutorial_Lab();
				$lab->initialize($row['tutorial_lab_id'], $row['tutorial_lab_name'], 
						$row['tutorial_lab_web_link'], $row['lab_status'], 
						$row['tutorial_lab_introduction'], $row['prerequisites'], 
						$row['key_topics'], $row['key_equations'], $row['description'], 
						$row['instructions'], $row['date_first_available']);
				$dataArray[] = $lab;
			}	
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}	
		
		return $dataArray;
	}	


	public function getAllowedStatusValues()
	{
		$lab = new Tutorial_Lab();
		$status_values = $lab->get_allowed_lab_status_values();
	}
	
	
	// The id will be auto-generated, when the new object is added to the database table.
	public function saveNew(&$tutorial_lab)
	{
		$db_connection = get_db_connection();
		$sucess = true;
		$tutorial_lab_name = $tutorial_lab->get_tutorial_lab_name();
		$tutorial_lab_web_link = $tutorial_lab->get_tutorial_lab_web_link();
		$lab_status = $tutorial_lab->get_lab_status();
		$tutorial_lab_introduction = $tutorial_lab->get_tutorial_lab_introduction();
		$prerequisites = $tutorial_lab->get_prerequisites();
		$key_topics = $tutorial_lab->get_key_topics();
		$key_equations = $tutorial_lab->get_key_equations();
		$description = $tutorial_lab->get_description();
		$instructions = $tutorial_lab->get_instructions();
		$date_first_available = $tutorial_lab->get_date_first_available();
		$table = $this->getTableName();
		
		// The id will be auto-generated
		$query = "insert into tutorial_lab (tutorial_lab_name, tutorial_lab_web_link, lab_status, 
				tutorial_lab_introduction, prerequisites, key_topics, key_equations, 
				description, instructions, date_first_available) 
		values ('$tutorial_lab_name', '$tutorial_lab_web_link', '$lab_status', 
				'$tutorial_lab_introduction', '$prerequisites', '$key_topics', 
				'$key_equations', '$description', '$instructions', '$date_first_available')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			// get the newly generated id
			$tutorial_lab_id = mysql_insert_id($db_connection);
			$tutorial_lab->set_tutorial_lab_id($tutorial_lab_id);	
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
	//($tutorial_lab_id, $tutorial_lab_name, $tutorial_lab_web_link, $lab_status, $tutorial_lab_introduction, $prerequisites, $key_topics, 
	// $key_equations, $description, $instructions, $date_first_available)
	public function updateAttribute($tutorial_lab, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$tutorial_lab_id = $tutorial_lab->get_tutorial_lab_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'tutorial_lab_id':
				return false;
				break;
			case 'tutorial_lab_name':
				$value = $tutorial_lab->get_tutorial_lab_name();
				$query = "update $table set tutorial_lab_name = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'tutorial_lab_web_link':	
				$value = $tutorial_lab->get_tutorial_lab_web_link();
				$query = "update $table set tutorial_lab_web_link = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'lab_status':
				$value = $tutorial_lab->get_lab_status();
				$query = "update $table set lab_status = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'tutorial_lab_introduction':
				$value = $tutorial_lab->get_tutorial_lab_introduction();
				$query = "update $table set tutorial_lab_introduction = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'prerequisites':
				$value = $tutorial_lab->get_prerequisites();
				$query = "update $table set prerequisites = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'key_topics':
				$value = $tutorial_lab->get_key_topics();
				$query = "update $table set key_topics = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'key_equations':
				$value = $tutorial_lab->get_key_equations();
				$query = "update $table set key_equations = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'description':
				$value = $tutorial_lab->get_description();
				$query = "update $table set description = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'instructions':	
				$value = $tutorial_lab->get_instructions();
				$query = "update $table set instructions = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
				break;
			case 'date_first_available':	
				$value = $tutorial_lab->get_date_first_available();
				$query = "update $table set date_first_available = '$value' where tutorial_lab_id = '$tutorial_lab_id'";
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


	public function deleteFromDatabase($tutorial_lab)
	{
		$db_connection = get_db_connection();
		$success = true;
		$tutorial_lab_id = $tutorial_lab->get_tutorial_lab_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where tutorial_lab_id = $tutorial_lab_id";
		
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