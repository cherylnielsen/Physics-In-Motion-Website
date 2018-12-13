<?php


class Tutorial_lab_controller extends DatabaseController {

	public function __construct() {}
	//($lab_id, $lab_name, $web_link, $lab_status, $short_description, $prerequisites, $key_topics, $key_equations, $long_description, $instructions)
	
	
	
	public function get_by_attribute($attribute_value, $attribute_type, $db_connection)
	{
		$lab_array = array();
		$query = "select * from tutorial_lab where $attribute_type = '$attribute_value'";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$lab = new Tutorial_lab();
				$lab->initialize($row['lab_id'], $row['lab_name'], $row['web_link'], $row['lab_status'], $row['short_description'], $row['prerequisites'], 
				$row['key_topics'], $row['key_equations'], $row['long_description'], $row['instructions']);
				$lab_array[] = $lab;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $lab_array;
	}
	
	
	public function get_all($db_connection)
	{
		$lab_array = array();
		$query = "select * from tutorial_lab";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$lab = new Tutorial_lab();
				$lab->initialize($row['lab_id'], $row['lab_name'], $row['web_link'], $row['lab_status'], $row['short_description'], $row['prerequisites'], 
				$row['key_topics'], $row['key_equations'], $row['long_description'], $row['instructions']);
				$lab_array[] = $lab;
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $lab_array;

	}
	
	
	public function update($tutorial_lab, $db_connection)
	{
		$sucess = true;
		// The lab_id should not be changed.
		$query = 'update tutorial_lab set lab_name = $tutorial_lab->lab_name, web_link = $tutorial_lab->web_link, lab_status = $tutorial_lab->lab_status, short_description = $tutorial_lab->short_description, $tutorial_lab->prerequisites, key_topics = $tutorial_lab->key_topics, key_equations = $tutorial_lab->key_equations, long_description = $tutorial_lab->long_description, instructions = $tutorial_lab->instructions
				where lab_id = $lab_id';
		
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


	public function save_new($tutorial_lab, $db_connection)
	{
		$sucess = true;
		// The lab_id is not included, because it is set automatically by the database.
		$query = 'insert into tutorial_lab ($lab_id, $lab_name, $web_link, $lab_status, $short_description, $prerequisites, $key_topics, $key_equations, $long_description, $instructions) 
		values (lab_name = $tutorial_lab->lab_name, web_link = $tutorial_lab->web_link, lab_status = $tutorial_lab->lab_status, short_description = $tutorial_lab->short_description, $tutorial_lab->prerequisites, key_topics = $tutorial_lab->key_topics, key_equations = $tutorial_lab->key_equations, long_description = $tutorial_lab->long_description, instructions = $tutorial_lab->instructions)';
					
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$tutorial_lab->set_lab_id(mysql_insert_id());
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New tutorial_lab could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}


}

?>