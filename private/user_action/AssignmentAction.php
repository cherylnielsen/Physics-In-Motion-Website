<?php

class AssignmentAction
{
	public function __construct() {}

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
	
	
}


?>

