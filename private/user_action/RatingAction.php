<?php

class RatingAction
{
	public function __construct() {}

	public function processRatingForm($mdb_control, $form_type, &$form_errors)
	{		
		$member_id = $_SESSION['member_id'];
		$rating = $_POST['rating'];
		$comments = $_POST['comments'];		
		$date_posted = $_POST['date_posted'];	
		
		// convert date to MySQL format
		$mysql_date_posted = date('Y-m-d H:i:s', strtotime($date_posted));				
		
		// sanitize text box inputs for safety
		$db_con = get_db_connection();		
		$comments = stripslashes(strip_tags(trim($comments)));
		$comments = mysqli_real_escape_string($db_con, $comments);	
		
		$sucess = true;
		$form_errors = "";				
		
		switch ($form_type)
		{
			case "section_rating":	
			
				$section_id = $_POST['section_id'];		
				$controller = $mdb_control->getController("section_rating");
				$theRating = new Section_Rating();
				
				$theRating->initialize(null, $section_id, 
							$member_id, $mysql_date_posted, $rating, 
							$comments);
							
				$sucess = $controller->saveNew($theRating);
				
				if($sucess)
				{
					$controller = $mdb_control->getController("section_student");
					$section_student = $controller->getByPrimaryKeys(
							"student_id", $member_id, "section_id", $section_id);
					$section_student->set_reviewed_section(true);
					$controller->updateAttribute($section_student, "reviewed_section");
				}				
				
				break;
				
			case "tutorial_lab_rating":
			
				$tutorial_lab_id = $_POST['tutorial_lab_id'];
				$controller = $mdb_control->getController("tutorial_lab_rating");
				$theRating = new Tutorial_Lab_Rating();
				
				$theRating->initialize(null, $tutorial_lab_id, 
							$member_id, $mysql_date_posted, $rating, 
							$comments);
							
				$sucess = $controller->saveNew($theRating);
				break;
		}
		
		if(!$sucess) 
		{ 
			$form_errors =  "<p>Sorry, the system was unable to process the form.</p>";
			return false; 
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
	

	public function getRating()
	{
		$rating = "";
		
		if (isset($_POST['rating']))
		{
			$rating = $_POST['rating']; 
		}
		else if (isset($_GET['rating']))
		{
			$rating = $_GET['rating']; 
		}
		
		return $rating;
	}
	

	public function getComments()
	{
		$comments = "";
		
		if (isset($_POST['comments']))
		{
			$comments = $_POST['comments']; 
		}
		else if (isset($_GET['comments']))
		{
			$comments = $_GET['comments']; 
		}
		
		return $comments;
	}
	

}


?>

