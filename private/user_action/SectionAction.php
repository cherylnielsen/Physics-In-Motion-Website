<?php

class SectionAction
{
	public function __construct() {}
	
	public function processTableForms($mdb_control)
	{
		if(isset($_POST['grade_homework_id']))
		{
			$hmwk_id = $_POST['grade_homework_id'];
			$grade = $_POST["grade_$hmwk_id"]; 
			$sucess = $this->gradeHomework($hmwk_id, $grade, $mdb_control);
		}		
		
		if(isset($_POST['change_grade_homework_id']))
		{
			$hmwk_id = $_POST['change_grade_homework_id'];
			$grade = $_POST["change_grade_$hmwk_id"]; 
			$sucess = $this->gradeHomework($hmwk_id, $grade, $mdb_control);
		}	
		
		if(isset($_POST['delete_assignment']))
		{
			$id = $_POST['delete_assignment'];
			$sucess = $this->deleteAssignment($id, $mdb_control);
		}
		
	}		
	
	
	public function deleteAssignment($assignment_id, $mdb_control)
	{
		$sucess = true;
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
			
			$sucess = $assignment_controller->deleteFromDatabase($assignment);
		}
		
		return $sucess;
	}
	
	
	public function submitHomework($homework_id, $mdb_control)
	{
		$sucess = true;
		
		$homework = new Homework();	
		$hmwk_control = $mdb_control->getController("homework");
		$homework = $hmwk_control->getByPrimaryKey("homework_id", $homework_id);
		$homework->set_date_submitted(date("Y/m/d"));
		
		$sucess = $hmwk_control->updateAttribute($homework, "date_submitted");		
		return $sucess;
	}
	
	
	public function gradeHomework($homework_id, $points_earned, $mdb_control)
	{
		$sucess = true;
		
		$homework = new Homework();	
		$hmwk_control = $mdb_control->getController("homework");
		$homework = $hmwk_control->getByPrimaryKey("homework_id", $homework_id);
		$homework->set_points_earned($points_earned);
		$homework->set_was_graded(true);
		
		$sucess = $hmwk_control->updateAttribute($homework, "points_earned");
		
		if($sucess) 
		{ 
			$sucess = $hmwk_control->updateAttribute($homework, "was_graded"); 
		}
		
		return $sucess;
	}
	
	
	
}


?>

