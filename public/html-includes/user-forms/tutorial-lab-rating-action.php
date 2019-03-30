<?php

	$doneURL = "";
	$form_errors = " ";
	
	if(isset($_SESSION["student_id"])) 
	{ 
		$doneURL = "student-home-page.php"; 
	}
	
	if(isset($_SESSION["professor_id"])) 
	{ 
		$doneURL = "professor-home-page.php"; 
	}	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_ok = $ratingAction->processRatingForm($mdb_control, 
					"tutorial_lab_rating", $form_errors);
		
		if($is_ok)
		{	
			header("Location: $doneURL");
			exit();
		}	
	}
	
?>	