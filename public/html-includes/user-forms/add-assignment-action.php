<?php

	$form_errors = " ";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_ok = $assignmentAction->processAssignmentForm($mdb_control, $form_type, $form_errors);
		
		if($is_ok)
		{
			echo "<div class='form_errors' id='form_errors' >
					<p>The new assignment has been added successfully.</p>
					</div>";
		}
	}
	
?>