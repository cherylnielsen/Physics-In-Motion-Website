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
	

	public function getListSectionsNeedingReview_ByStudent($student_id, $mdb_control)
	{
		$sections_2b_rated = array();
		$student_sections = array();
		
		$section_controller = $mdb_control->getController("section_student");
		$student_sections = $section_controller->getByAttribute("student_id", $student_id);	
		
		$section_controller = $mdb_control->getController("section");
		$rating_controller = $mdb_control->getController("section_rating");
				
		for($i = 0; $i < count($student_sections); $i++)
		{
			$section_id = $student_sections[$i]->get_section_id();
			$student_section_rating = $rating_controller->getByPrimaryKeys("section_id", 
						$section_id, "member_id", $student_id);
			
			// if the student has not rated this section, add it to the list
			if(!isset($student_section_rating))
			{				
				$section = $section_controller->getByPrimaryKey("section_id", $section_id);
				$sec_id = $section->get_section_id();
				$sec_name = $section->get_section_name();
				$sections_2b_rated[$i]['id'] = "$sec_id"; 
				$sections_2b_rated[$i]['name'] = "Section $sec_id : $sec_name";
			}
		}
		
		return $sections_2b_rated;		
	}
	

	public function flagRatingForReview($rating_id, $rating_type, $mdb_control)
	{
	}
	
	
	
}


?>

