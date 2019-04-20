<?php

class SectionAction
{
	public function __construct() {}
	
	public function getSection($mdb_control)
	{
		if(isset($_POST['get_section']))
		{
			$section_id = $_POST['get_section'];
			$control = $mdb_control->getController("section_view");
			$section = $hmwk_control->getByPrimaryKey("section_id", $section_id);
			
			$section_name = $section->get_section_name();
			$start_date = $section->get_start_date();
			$end_date = $section->get_end_date();
			$description = $section->get_section_description();
			$professor_id = $section->get_professor_id();
			$first_name = $section->get_professor_first_name();
			$last_name = $section->get_professor_last_name();
			$professor_name = "$first_name $last_name";
			
			$dataStr = "section_id=" . $section_id . "&section_name=" . $section_name . 
						"&start_date=" . $start_date . "&end_date=" . $end_date . 
						"&description=" . $description .
						"&professor_id=" . $professor_id . "&professor_name=" . $professor_name;
			
			return $dataStr;
		}
	}
	
	public function processTableForms($mdb_control)
	{		
		if(isset($_POST['submit_homework']))
		{
			$homework_id = $_POST['submit_homework'];
			$result = $this->submitHomework($homework_id, $mdb_control);
			return $result;			
		}

		if(isset($_POST['delete_assignment']))
		{
			$assignment_id = $_POST['delete_assignment'];
			$result = $this->deleteAssignment($assignment_id, $mdb_control);
			return $result;
		}
		
		if(isset($_POST['grade_homework']))
		{
			$homework_id = $_POST['grade_homework'];
			$grade = $_POST["grade_$homework_id"]; 
			$row_id = "homework_row_$homework_id";
			$section = $_GET['section_id'];
			$success = $this->gradeHomework($homework_id, $grade, $mdb_control);
			$returnURL = "professor-home-page.php?section_id=$section#";
			$returnURL .= $row_id;
			
			header("Location: $returnURL");
			exit();			
		}	
	}
		
	
	public function submitHomework($homework_id, $mdb_control)
	{
		$success = true;
		
		$homework = new Homework();	
		$hmwk_control = $mdb_control->getController("homework");
		$homework = $hmwk_control->getByPrimaryKey("homework_id", $homework_id);
		
		$datetime = date("Y/m/d");
		$datetime2 = date("D, m/d/y");		
		$homework->set_date_submitted($datetime);		
		$success = $hmwk_control->updateAttribute($homework, "date_submitted");	
		
		if($success) 
		{ 
			return $datetime2; 
		}
		
		return -1;
	}
	
	
	public function gradeHomework($homework_id, $points_earned, $mdb_control)
	{
		$success = true;
		
		$homework = new Homework();	
		$hmwk_control = $mdb_control->getController("homework");
		$homework = $hmwk_control->getByPrimaryKey("homework_id", $homework_id);
		$homework->set_points_earned($points_earned);
		$homework->set_was_graded(true);
		
		$success = $hmwk_control->updateAttribute($homework, "points_earned");
		
		if($success) 
		{ 
			$success = $hmwk_control->updateAttribute($homework, "was_graded"); 
		}
		
		return $success;
			
	}
	
	
	public function deleteAssignment($assignment_id, $mdb_control)
	{
		$success = true;
		$assignment = new Assignment();
		$fileAction = new FileAction();
		
		$assignment_controller = $mdb_control->getController("assignment");		
		$assignment = $assignment_controller->getByPrimaryKey("assignment_id", $assignment_id);
		
		if(!is_null($assignment))
		{		
			$attachment_controller = $mdb_control->getController("assignment_attachment");	
			$attachments = $attachment_controller->getByAttribute("assignment_id", $assignment_id);
			
			if(!is_null($attachments) && (count($attachments) > 0))
			{
				$filepath = $attachments[0]->get_filepath();
				$url = '../../public/' . $filepath;
				
				for($i = 0; $i < count($attachments); $i++)
				{	
					$attachment_controller->deleteFromDatabase($attachments[$i]);
				}	
				
				$fileAction->deleteDirectory($url);
			}
			
			// This will fail automatically if any of the attachments could not be deleted 
			// from the database, due to the foreign key constraint.
			$success = $assignment_controller->deleteFromDatabase($assignment);
		}
		
		if(!$success) { return -1; }
		
		return "ok";
		
	}
	
	
	
	
}


?>

