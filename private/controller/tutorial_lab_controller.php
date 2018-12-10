<?php

require_once('../database-access.php');
require_once('../model/Tutorial_lab.php');

class Tutorial_lab_controller {

	public function Tutorial_lab_controller() {}
	//($lab_id, $lab_name, $web_link, $lab_status, $short_description)
	//($lab_id, $lab_name, $web_link, $lab_status, $short_description, $prerequisites, $key_topics, $key_equations, $long_description, $instructions)
	
	public function get_tutorial_lab_by_id($lab_id)
	{
		$tutorial_lab = new Tutorial_lab();
		$query = 'select * from tutorial_lab where lab_id = $lab_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$tutorial_lab->initialize($row['lab_id'], $row['lab_name'], $row['web_link'], $row['lab_status'], 
				$row['short_description'], $row['prerequisites'], $row['key_topics'], 
				$row['key_equations'], $row['instructions'], $row['long_description']);
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
		$tutorial_lab = new Tutorial_lab();
		$query = 'select * from tutorial_lab where web_link = $web_link';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$tutorial_lab->initialize($row['lab_id'], $row['lab_name'], $row['web_link'], $row['lab_status'], 
				$row['short_description'], $row['prerequisites'], $row['key_topics'], 
				$row['key_equations'], $row['instructions'], $row['long_description']);
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
	

	public function update_tutorial_lab_short($tutorial_lab)
	{
		$sucess = true;
		// The lab_id should not be changed.
		$query = 'update tutorial_lab set lab_name = $tutorial_lab->lab_name, web_link = $tutorial_lab->web_link, lab_status = $tutorial_lab->lab_status, short_description = $tutorial_lab->short_description
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


	public function update_tutorial_lab_more($tutorial_lab)
	{
		$sucess = true;
		// The lab_id should not be changed.
		$query = 'update tutorial_lab set prerequisites = $tutorial_lab->prerequisites, key_topics = $tutorial_lab->key_topics, key_equations = $tutorial_lab->key_equations, long_description = $tutorial_lab->long_description, instructions = $tutorial_lab->instructions 
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


	public function save_new_tutorial_lab_short($tutorial_lab)
	{
		$sucess = true;
		// The lab_id is not included, because it is set automatically by the database.
		$query = 'insert into tutorial_lab (lab_name, web_link, lab_status, short_description) 
					values ($tutorial_lab->lab_name, $tutorial_lab->web_link, $tutorial_lab->lab_status, $tutorial_lab->short_description)';
					
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$tutorial_lab->lab_id = mysql_insert_id();
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

	public function save_new_tutorial_lab_more($tutorial_lab)
	{
		$sucess = true;
		// The lab_id is not included, because it is set automatically by the database.
		$query = 'insert into tutorial_lab (prerequisites, key_topics, key_equations, long_description, instructions) 
		values ($tutorial_lab->prerequisites, $tutorial_lab->key_topics, $tutorial_lab->key_equations, $tutorial_lab->long_description, $tutorial_lab->instructions)';
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$tutorial_lab->lab_id = mysql_insert_id();
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