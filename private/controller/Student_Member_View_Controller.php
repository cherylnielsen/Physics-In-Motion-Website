<?php


class Student_Member_View_Controller extends DatabaseController
{
	
	public function __construct() {}
	// $student_id, $first_name, $last_name, $email, $school_name


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$student_member_view = new Student_Member_View();
				$student_member_view->set_student_id($row['student_id']);
				$student_member_view->set_first_name($row['first_name']);
				$student_member_view->set_last_name($row['last_name']);
				$student_member_view->set_email($row['email']);
				$student_member_view->set_school_name($row['school_name']);
				// pushes each object onto the end of the array
				$dataArray[] = $student_member_view;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// updates the given key with the new value in the database
	public function updateAttribute($student_member_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$student_id = $student_member_view->get_student_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'student_id':
				return false;
				break;
			case 'first_name':
				$value = $student_member_view->get_first_name();
				$query = "update $table set first_name = '$value' where student_id = '$student_id'";
				break;
			case 'last_name':
				$value = $student_member_view->get_last_name();
				$query = "update $table set last_name = '$value' where student_id = '$student_id'";
				break;
			case 'school_name':
				$value = $student_member_view->get_school_name();
				$query = "update $table set school_name = '$value' where student_id = '$student_id'";
				break;
			case 'email':
				$value = $student_member_view->get_email();
				$query = "update $table set email = '$value' where student_id = '$student_id'";
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


	public function saveNew(&$student_member_view)
	{
		return false;
	}


	public function deleteFromDatabase($student_member_view)
	{
		return false;
	}
	

}

?>