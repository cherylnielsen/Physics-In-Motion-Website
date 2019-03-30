<?php

	$section_id;
	
	if (isset($_POST['section_id']))
	{
		$section_id = $_POST['section_id']; 
	}
	else if (isset($_GET['section_id']))
	{
		$section_id = $_GET['section_id']; 
	}
		
	$returnURL = "professor-home-page.php?section_id=$section_id";
	$form_errors = " ";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_ok = $assignmentAction->processAssignmentForm($mdb_control, $form_type, $form_errors);
		
		if($is_ok)
		{	
			header("Location: $returnURL");
			exit();
		}	
	}
	
?>