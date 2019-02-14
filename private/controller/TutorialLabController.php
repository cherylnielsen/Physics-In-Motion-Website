<?php



class TutorialLabController extends DatabaseController {
	
	
	public function __construct() {}
	//($lab_id, $lab_name, $web_link, $lab_status, $introduction, $prerequisites, $key_topics, 
	// $key_equations, $description, $instructions, $date_first_available)

	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$lab = new Tutorial_Lab();
				$lab->initialize($row['lab_id'], $row['lab_name'], $row['web_link'], $row['lab_status'], $row['introduction'], 
							$row['prerequisites'], $row['key_topics'], $row['key_equations'], $row['description'], 
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
		$db_connection = $this->get_db_connection();
		$sucess = true;
		$lab_name = $tutorial_lab->get_lab_name();
		$web_link = $tutorial_lab->get_web_link();
		$lab_status = $tutorial_lab->get_lab_status();
		$introduction = $tutorial_lab->get_introduction();
		$prerequisites = $tutorial_lab->get_prerequisites();
		$key_topics = $tutorial_lab->get_key_topics();
		$key_equations = $tutorial_lab->get_key_equations();
		$description = $tutorial_lab->get_description();
		$instructions = $tutorial_lab->get_instructions();
		$date_first_available = $tutorial_lab->get_date_first_available();
		$table = $this->getTableName();
		
		// The id will be auto-generated
		$query = "insert into tutorial_lab (lab_name, web_link, lab_status, introduction, prerequisites, 
				key_topics, key_equations, description, instructions, date_first_available) 
		values ('$lab_name', '$web_link', '$lab_status', '$introduction', '$prerequisites', '$key_topics', 
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
	
	
	// updates the given attribute with the new value in the database and in the tutorial_lab object
	//($lab_id, $lab_name, $web_link, $lab_status, $introduction, $prerequisites, $key_topics, 
	// $key_equations, $description, $instructions, $date_first_available)
	public function updateAttribute(&$tutorial_lab, $attribute, $value)
	{
		$db_connection = $this->get_db_connection();
		$success = true;
		$lab_id = $tutorial_lab->get_lab_id();	
		$table = $this->getTableName();
		
		switch ($attribute)
		{
			case 'lab_id':
				return false;
				break;
			case 'lab_name':
				$tutorial_lab->set_lab_name($value);	
				$query = "update $table set lab_name = '$value' where lab_id = '$lab_id'";
				break;
			case 'web_link':
				$tutorial_lab->set_web_link($value);	
				$query = "update $table set web_link = '$value' where lab_id = '$lab_id'";
				break;
			case 'lab_status':
				$tutorial_lab->set_lab_status($value);	
				$query = "update $table set lab_status = '$value' where lab_id = '$lab_id'";
				break;
			case 'introduction':
				$tutorial_lab->set_introduction($value);	
				$query = "update $table set introduction = '$value' where lab_id = '$lab_id'";
				break;
			case 'prerequisites':
				$tutorial_lab->set_prerequisites($value);	
				$query = "update $table set prerequisites = '$value' where lab_id = '$lab_id'";
				break;
			case 'key_topics':
				$tutorial_lab->set_key_topics($value);	
				$query = "update $table set key_topics = '$value' where lab_id = '$lab_id'";
				break;
			case 'key_equations':
				$tutorial_lab->set_key_equations($value);	
				$query = "update $table set key_equations = '$value' where lab_id = '$lab_id'";
				break;
			case 'description':
				$tutorial_lab->set_description($value);	
				$query = "update $table set description = '$value' where lab_id = '$lab_id'";
				break;
			case 'instructions':
				$tutorial_lab->set_instructions($value);	
				$query = "update $table set instructions = '$value' where lab_id = '$lab_id'";
				break;
			case 'date_first_available':
				$tutorial_lab->set_date_first_available($value);	
				$query = "update $table set date_first_available = '$value' where lab_id = '$lab_id'";
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
		$db_connection = $this->get_db_connection();
		$success = true;
		$lab_id = $tutorial_lab->get_lab_id();
		$table = $this->getTableName();
		
		$query = "delete from $table where lab_id = $lab_id";
		
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