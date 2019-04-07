<?php

	$error_array = array();
	$form_errors = " ";
	$returnURL = "professor-home-page.php";
	
	if (isset($_POST['section_id']))
	{
		$section_id = $_POST['section_id']; 
		$returnURL = "professor-home-page.php?section_id=$section_id";
	}
	else if (isset($_GET['section_id']))
	{
		$section_id = $_GET['section_id']; 
		$returnURL = "professor-home-page.php?section_id=$section_id";
	}
		
	
	

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_ok = $assignmentAction->processAssignmentForm($mdb_control, $form_type, $error_array);
		
		if($is_ok)
		{	
			header("Location: $returnURL");
			exit();
		}
		else
		{
			$form_errors .= "<h2>ERROR: </h2>";
			
			for($i = 0; $i < count($error_array); $i++)
			{
				$form_errors .= "<p>" . $error_array[$i] . "</p>";
			}
		}		
	}

?>