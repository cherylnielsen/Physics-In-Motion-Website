<?php

class AssignmentAction
{
	public function __construct() {}

	public function processAssignmentForm($mdb_control, $form_type)
	{
		$sucess = true;
		$controller = $mdb_control->getController("assignment");
		$assignment = new Assignment();
		
		$section_id = $_POST['section_id'];		
		$tutorial_lab_id = $_POST['tutorial_lab_id']; 
		$points_possible = $_POST['points_possible'];
		
		// convert dates to mysql format
		$date_assigned = $_POST['date_assigned'];	
		$mysql_date_assigned = date('Y-m-d H:i:s', strtotime($date_assigned));				
		$date_due = $_POST['date_due']; 		
		$mysql_date_due = date('Y-m-d H:i:s', strtotime($date_due));
				
		// test assignment_name for unsafe characters because it is input from text box
		$assignment_name = $_POST['assignment_name'];
		
		if (!preg_match("/^[a-zA-Z0-9 \-]*$/", $assignment_name)) 
		{
			echo "<p>Assignment Name can only contain letters, numbers, dashes, and white space.</p>";  
			return false;
		}
		
		// sanitize assignment_name because it is input from text box
		$db_con = get_db_connection();		
		$name = stripslashes(strip_tags(trim($assignment_name)));
		$assignment_name = mysqli_real_escape_string($db_con, $name);
		
		//db_linked_files/assignment
		//$new_notes = ??;	
		// call function to test file types, etc.
		$attachments = null;
		
		switch ($form_type)
		{
			case "edit_assignment":				
				$assignment_id = $_POST['assignment_id']; 
				
				$assignment->initialize($assignment_id, $section_id, $tutorial_lab_id, 
							$assignment_name, $mysql_date_assigned, $mysql_date_due, 
							$points_possible, $attachments);
							
				$sucess = $controller->updateAll($assignment);
				break;
				
			case "add_assignment":
				$assignment_id = null; 
				
				$assignment->initialize($assignment_id, $section_id, $tutorial_lab_id, 
							$assignment_name, $mysql_date_assigned, $mysql_date_due, 
							$points_possible, $attachments);
							
				$sucess = $controller->saveNew($assignment);
				break;
		}
		
		return $sucess;				
	}
	
	
	public function getSectionID()
	{
		$section_id = "";
		
		if (isset($_POST['section_id']))
		{
			$section_id = $_POST['section_id']; 
		}
		else if (isset($_GET['section_id']))
		{
			$section_id = $_GET['section_id']; 
		}
		
		return $section_id;
	}

	
	public function getAssignmentID()
	{
		$assignment_id = "";
		
		if (isset($_POST['assignment_id']))
		{
			$assignment_id = $_POST['assignment_id']; 
		}
		else if (isset($_GET['assignment_id']))
		{
			$assignment_id = $_GET['assignment_id']; 
		}
		
		return $assignment_id;
	}


	public function getTutorialLabID()
	{
		$tutorial_lab_id = "";
		
		if (isset($_POST['tutorial_lab_id']))
		{
			$tutorial_lab_id = $_POST['tutorial_lab_id']; 
		}
		else if (isset($_GET['tutorial_lab_id']))
		{
			$tutorial_lab_id = $_GET['tutorial_lab_id']; 
		}
		
		return $tutorial_lab_id;
	}
	

	public function getSectionName()
	{
		$section_name = "";
		
		if (isset($_POST['section_name']))
		{
			$section_name = $_POST['section_name']; 
		}
		else if (isset($_GET['section_name']))
		{
			$section_name = $_GET['section_name']; 
		}
		
		return $section_name;
	}


	public function getAssignmentName()
	{
		$assignment_name = "";
		
		if (isset($_POST['assignment_name']))
		{
			$assignment_name = $_POST['assignment_name']; 
		}
		else if (isset($_GET['assignment_name']))
		{
			$assignment_name = $_GET['assignment_name']; 
		}
		
		return $assignment_name;
	}
	
	
	public function getDateAssigned()
	{
		$date_assigned = "";
		
		if (isset($_POST['date_assigned']))
		{
			$date_assigned = $_POST['date_assigned']; 
		}
		else if (isset($_GET['date_assigned']))
		{
			$date_assigned = $_GET['date_assigned']; 
		}
		else
		{
			$date_assigned = date('m/d/Y');
		}
		
		return $date_assigned;
	}
	

	public function getDateDue()
	{
		$date_due = "";
		
		if (isset($_POST['date_due']))
		{
			$date_due = $_POST['date_due']; 
		}
		else if (isset($_GET['date_due']))
		{
			$date_due = $_GET['date_due']; 
		}
		
		return $date_due;
	}


	public function getPointsPossible()
	{
		$points_possible = "";
		
		if (isset($_POST['points_possible']))
		{
			$points_possible = $_POST['points_possible']; 
		}
		else if (isset($_GET['points_possible']))
		{
			$points_possible = $_GET['points_possible']; 
		}
		
		return $points_possible;
	}


	public function getTutorialLabIDEdit($assignment_view)
	{
		$tutorial_lab_id = "";
		
		if (isset($_POST['tutorial_lab_id']))
		{
			$tutorial_lab_id = $_POST['tutorial_lab_id']; 
		}
		else if (isset($_GET['tutorial_lab_id']))
		{
			$tutorial_lab_id = $_GET['tutorial_lab_id']; 
		}
		else if (isset($assignment_view))
		{
			$tutorial_lab_id = $assignment_view->get_tutorial_lab_id();
		}
		
		return $tutorial_lab_id;
	}
	

	public function getSectionNameEdit($assignment_view)
	{
		$section_name = "";
		
		if (isset($_POST['section_name']))
		{
			$section_name = $_POST['section_name']; 
		}
		else if (isset($_GET['section_name']))
		{
			$section_name = $_GET['section_name']; 
		}
		else if (isset($assignment_view))
		{
			$section_name = $assignment_view->get_section_name();
		}
		
		return $section_name;
	}


	public function getAssignmentNameEdit($assignment_view)
	{
		$assignment_name = "";
		
		if (isset($_POST['assignment_name']))
		{
			$assignment_name = $_POST['assignment_name']; 
		}
		else if (isset($_GET['assignment_name']))
		{
			$assignment_name = $_GET['assignment_name']; 
		}
		else if (isset($assignment_view))
		{
			$assignment_name = $assignment_view->get_assignment_name();
		}
		
		return $assignment_name;
	}
	
	
	public function getDateAssignedEdit($assignment_view)
	{
		$date_assigned = "";
		
		if (isset($_POST['date_assigned']))
		{
			$date_assigned = $_POST['date_assigned']; 
		}
		else if (isset($_GET['date_assigned']))
		{
			$date_assigned = $_GET['date_assigned']; 
		}
		else if (isset($assignment_view))
		{
			$date_assigned = $assignment_view->get_date_assigned();
			$time = strtotime($date_assigned);
			$date_assigned = date("m/d/Y", $time);
		}
		
		return $date_assigned;
	}
	

	public function getDateDueEdit($assignment_view)
	{
		$date_due = "";
		
		if (isset($_POST['date_due']))
		{
			$date_due = $_POST['date_due']; 
		}
		else if (isset($_GET['date_due']))
		{
			$date_due = $_GET['date_due']; 
		}
		else if (isset($assignment_view))
		{
			$date_due = $assignment_view->get_date_due();
			$time = strtotime($date_due);
			$date_due = date("Y-m-d", $time);
		}
		
		return $date_due;
	}


	public function getPointsPossibleEdit($assignment_view)
	{
		$points_possible = "";
		
		if (isset($_POST['points_possible']))
		{
			$points_possible = $_POST['points_possible']; 
		}
		else if (isset($_GET['points_possible']))
		{
			$points_possible = $_GET['points_possible']; 
		}
		else if (isset($assignment_view))
		{
			$points_possible = $assignment_view->get_points_possible();
		}
		
		return $points_possible;
	}
	
	
}


?>

