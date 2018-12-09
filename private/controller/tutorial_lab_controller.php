<?php

require_once('../database-access.php');
require_once('../model/tutorial_lab.php');

class tutorial_lab_controller {

	public function tutorial_lab_controller() {}

	public function get_tutorial_lab_by_id($lab_id)
	{
		$tutorial_lab = new tutorial_lab();
		$query = 'select * from tutorial_lab where lab_id = $lab_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$tutorial_lab->initialize($row['lab_id'], $row['lab_name'], $row['web_link'], $row['lab_status'], 
				$row['short_description'], $row['long_description'], $row['prerequisites'], $row['key_topics'], 
				$row['key_equations'], $row['instructions']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$tutorial_lab = null;
		}

		mysqli_close($db_connection);
		return tutorial_lab;

	}
	
	
	public function get_tutorial_lab_by_web_link($web_link)
	{
		$tutorial_lab = new tutorial_lab();
		$query = 'select * from tutorial_lab where web_link = $web_link';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$tutorial_lab->initialize($row['lab_id'], $row['lab_name'], $row['web_link'], $row['lab_status'], 
				$row['short_description'], $row['long_description'], $row['prerequisites'], $row['key_topics'], 
				$row['key_equations'], $row['instructions']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$tutorial_lab = null;
		}

		mysqli_close($db_connection);
		return tutorial_lab;

	}
	

	public function update_tutorial_lab_short($lab_id, $lab_name, $web_link, $lab_status, $short_description)
	{
		$sucess = true;
		// The lab_id should not be changed.
		$query = 'update tutorial_lab set lab_name = $lab_name, web_link = $web_link, lab_status = $lab_status, 
					short_description = $short_description
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


	public function update_tutorial_lab_long($lab_id, $lab_name, $web_link, $lab_status, $short_description, $long_description, $prerequisites, $key_topics, $key_equations, $instructions)
	{
		$sucess = true;
		// The lab_id should not be changed.
		$query = 'update tutorial_lab set lab_name = $lab_name, web_link = $web_link, lab_status = $lab_status, 
					short_description = $short_description, long_description = $long_description, 
					prerequisites = $prerequisites, key_topics = $key_topics, key_equations = $key_equations,
					instructions = $instructions 
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


	public function save_new_tutorial_lab_short($lab_id, $lab_name, $web_link, $lab_status, $short_description)
	{
		$sucess = true;
		// The lab_id is not included, because it is set automatically by the database.
		$query = 'insert into tutorial_lab (lab_name, web_link, lab_status, short_description) 
					values ($lab_name, $web_link, $lab_status, $short_description)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
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

	public function save_new_tutorial_lab_long($lab_id, $lab_name, $web_link, $lab_status, $short_description, $long_description, $prerequisites, $key_topics, $key_equations, $instructions)
	{
		$sucess = true;
		// The lab_id is not included, because it is set automatically by the database.
		$query = 'insert into tutorial_lab (lab_name, web_link, lab_status, short_description, long_description, prerequisites, key_topics, key_equations, instructions) 
		values ($lab_name, $web_link, $lab_status, $short_description, $long_description, $prerequisites, $key_topics, $key_equations, $instructions)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
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