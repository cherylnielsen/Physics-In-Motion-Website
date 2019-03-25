<?php

	$cancelURL = "professor-section-page.php?section_id=$section_id";
	$form_errors = " ";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_ok = $assignmentAction->processAssignmentForm($mdb_control, $form_type, $form_errors);
		
		if($is_ok)
		{	
			header("Location: $cancelURL");
			exit();
		}	
	}

?>