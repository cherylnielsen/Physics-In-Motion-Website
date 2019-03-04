<?php


class Professor_Member_View_Controller extends DatabaseController
{
	public function __construct() {}
	// $professor_id, $first_name, $last_name, $email, $school_name


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$professor_member_view = new Professor_Member_View();
				$professor_member_view->set_professor_id($row['professor_id']);
				$professor_member_view->set_first_name($row['first_name']);
				$professor_member_view->set_first_name($row['last_name']);
				$professor_member_view->set_email($row['email']);
				$professor_member_view->set_school_name($row['school_name']);
				// pushes each object onto the end of the array
				$dataArray[] = $professor_member_view;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// updates the given key with the new value in the database
	public function updateAttribute($professor_member_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$professor_id = $professor_member_view->get_professor_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'professor_id':
				return false;
				break;
			case 'first_name':
				$value = $professor_member_view->get_first_name();
				$query = "update $table set first_name = '$value' where professor_id = '$professor_id'";
				break;
			case 'last_name':
				$value = $professor_member_view->get_last_name();
				$query = "update $table set last_name = '$value' where professor_id = '$professor_id'";
				break;
			case 'school_name':
				$value = $professor_member_view->get_school_name();
				$query = "update $table set school_name = '$value' where professor_id = '$professor_id'";
				break;
			case 'email':
				$value = $professor_member_view->get_email();
				$query = "update $table set email = '$value' where professor_id = '$professor_id'";
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


	public function saveNew(&$professor_member_view)
	{
		return false;
	}


	public function deleteFromDatabase($professor_member_view)
	{
		return false;
	}
	

}

?>