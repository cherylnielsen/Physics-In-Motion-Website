<?php


class Administrator_Member_View_Controller extends DatabaseController
{
	
	public function __construct() {}
	// $administrator_id, $first_name, $last_name, $email, $admin_type


	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$administrator_member_view = new Administrator_Member_View();
				$administrator_member_view->set_administrator_id($row['administrator_id']);
				$administrator_member_view->set_first_name($row['first_name']);
				$administrator_member_view->set_last_name($row['last_name']);
				$administrator_member_view->set_email($row['email']);
				$administrator_member_view->set_admin_type($row['admin_type']);
				// pushes each object onto the end of the array
				$dataArray[] = $administrator_member_view;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// updates the given key with the new value in the database
	public function updateAttribute($administrator_member_view, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$administrator_id = $administrator_member_view->get_administrator_id();	
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'administrator_id':
				return false;
				break;
			case 'first_name':
				$value = $administrator_member_view->get_first_name();
				$query = "update $table set first_name = '$value' where administrator_id = '$administrator_id'";
				break;
			case 'last_name':
				$value = $administrator_member_view->get_last_name();
				$query = "update $table set last_name = '$value' where administrator_id = '$administrator_id'";
				break;
			case 'admin_type':
				$value = $administrator_member_view->get_admin_type();
				$query = "update $table set admin_type = '$value' where administrator_id = '$administrator_id'";
				break;
			case 'email':
				$value = $administrator_member_view->get_email();
				$query = "update $table set email = '$value' where administrator_id = '$administrator_id'";
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


	public function saveNew(&$administrator_member_view)
	{
		return false;
	}


	public function deleteFromDatabase($administrator_member_view)
	{
		return false;
	}
	

}

?>