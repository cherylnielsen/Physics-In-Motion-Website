<?php

	$doneURL = "student-home-page.php";
	$form_errors = " ";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_ok = $ratingAction->processRatingForm($mdb_control, "section_rating", $form_errors);
		
		if($is_ok)
		{	
			header("Location: $doneURL");
			exit();
		}	
	}
	
?>	