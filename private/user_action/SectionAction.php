<?php

class SectionAction
{
	public function __construct() {}
	
	public function processTableForms($mdb_control)
	{
		$result = 0;
		
		if(isset($_POST['submit_homework']))
		{
			$mdb_control = new DatabaseControllerFactory();	
			$homework_id = $_POST['submit_homework'];
			$result = $this->submitHomework($homework_id, $mdb_control);
		}

		return $result;
			
	}
		
		
		
		
		/**
		else
		{
			echo "post is not set , ";
		}
		
		
		if(isset($_POST['grade_homework']))
		{
			$homework_id = $_POST['grade_homework'];
			$grade = $_POST["grade_$homework_id"]; 
			$result = $this->gradeHomework($homework_id, $grade, $mdb_control);
		}		
		

		if(isset($_POST['change_grade']))
		{
			$homework_id = $_POST['change_grade'];
			$grade = $_POST["change_grade_$homework_id"]; 
			$result = $this->gradeHomework($homework_id, $grade, $mdb_control);
		}	

		
		if(isset($_POST['delete_assignment']))
		{
			$assignment_id = $_POST['delete_assignment'];
			$result = $this->deleteAssignment($assignment_id, $mdb_control);
		}
		
		return $result;
		
		**/
		
	
	
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
		
		return 0;
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
		
		if($success) 
		{ 
			$gradeString = "points_earned=" . $points_earned . "&was_graded=1";
			return $gradeString; 
		}
		
		return 0;
	}
	
	
	public function deleteAssignment($assignment_id, $mdb_control)
	{
		$success = true;
		$filesDeleted = 0;
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
				$fileAction->deleteDirectory($filepath);
				
				for($i = 0; $i < count($attachments); $i++)
				{	
					$attachment_controller->deleteFromDatabase($attachments[$i]);
				}				
			}
			
			// This will fail automatically if any of the attachments could not be deleted 
			// from the database, due to the foreign key constraint.
			$success = $assignment_controller->deleteFromDatabase($assignment);
		}
		
		return $success;
	}
	
	
}


?>

