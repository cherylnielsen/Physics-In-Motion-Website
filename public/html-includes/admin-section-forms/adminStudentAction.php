<?php

class adminStudentAction
{
	public function __construct() {}
	
	
	public function processForm($mdb_control)
	{	
		$error_array = array();
		$success = true;
		$action = "";
		$section_id = "";
		$result = array();
		
		if(isset($_POST["action_type"]))
		{
			$action = $_POST["action_type"];
			$section_id = $_POST["section_id"];
			
			switch ($action)
			{
				case "add":
				
					if(isset($_FILES["attachments"]) && ($_FILES["attachments"]["error"] == UPLOAD_ERR_OK))
					{
						$success = $this->addMultiStudents($mdb_control, $error_array);
					}
					else
					{
						$student_id = $_POST["student_id"];						
						$success = $this->addStudent($student_id, $section_id, 
													$mdb_control, $error_array);
					}
					
				break;
				
				case "drop":
				
					if(isset($_FILES["attachments"]) && ($_FILES["attachments"]["error"] == UPLOAD_ERR_OK))
					{
						$success = $this->dropMultiStudents($mdb_control, $error_array);
					}
					else
					{
						$student_id = $_POST["student_id"];
						$success = $this->dropStudent($student_id, $section_id, 
													$mdb_control, $error_array);
					}
					
				break;
				
				default:
					$error_array[] = "Sorry, unknown action type, the request could not be 
										processed at this time. Please try again later.";
					$success = false;
			}
		}
		else
		{
			$error_array[] = "Sorry, action type not set, the request could not be 
								processed at this time. Please try again later.";
			$success = false;
		}
		
		if($success)
		{	
			$form_errors = "<h2>SUCCESS: </h2>";
			
			if(strcmp($action, "add") == 0)
			{
				$form_errors .= "<p>The students have been added to Section $section_id.</p>";
			}			
			else if(strcmp($action, "drop") == 0)
			{
				$form_errors .= "<p>The students have been dropped from Section $section_id.</p>";
			}
			
			$form_errors .= "<br>";
			
		}
		else
		{
			$form_errors = "<h2>ERROR: </h2>";
			
			for($i = 0; $i < count($error_array); $i++)
			{
				$form_errors .= "<p>" . $error_array[$i] . "</p>";
			}
			
			$form_errors .= "<br>";
		}
		
		$result['success'] = $success;
		$result['form_errors'] = $form_errors;
		return $result;
	}
	
	
	public function addStudent($student_id, $section_id, $mdb_control, &$error_array)
	{
		$success = true;
		
		$controller = $mdb_control->getController("section_student");
		
		if(isset($controller))
		{
			$section_student = new Section_Student();
			// setting dropped_section = false
			$section_student->initialize($section_id, $student_id, false);
			$sucess = $controller->saveNew($section_student);
		}
		
		return $success;
	}
	
	
	public function dropStudent($student_id, $section_id, $mdb_control, &$error_array)
	{
		$success = true;
		
		$controller = $mdb_control->getController("section_student");
		
		if(isset($controller))
		{
			$section_student = new Section_Student();
			// setting dropped_section = true
			$section_student->initialize($section_id, $student_id, true);
			$sucess = $controller->updateAttribute($section_student, "dropped_section");
		}
		
		return $success;
	}
	
	
	public function addMultiStudents($mdb_control, &$error_array)
	{
		$success = true;
		
		$controller = $mdb_control->getController("section_student");
		
		if(isset($controller) && isset($_POST["section_id"]) && isset($_FILES["attachments"]))
		{
			$section_id = $_POST["section_id"];
			
			// each file line = section id, student id, first name, last name
			// get the file, but do not save it?
			// read the file 
			// sanitize each line
			// save line into an array (one csv line per student)
			// section id matches section chosen in form
			// check name and student id match database
			// save each student that is ok
			// output errors or list of students that could not be added
			/**
			$success = $this->addStudent($student_id, $section_id, 
										$mdb_control, $error_array);
			**/
			$success = false;
			$error_array[] = "The mulit-student add feature is not yet available";
		}
		
		return $success;
	}
	
	
	public function dropMultiStudents($mdb_control, &$error_array)
	{
		$success = true;
		
		$controller = $mdb_control->getController("section_student");
		
		if(isset($controller) && isset($_POST["section_id"]) && isset($_FILES["attachments"]))
		{
			$section_id = $_POST["section_id"];
			
			// each file line = section id, student id, first name, last name
			// get the file, but do not save it?
			// read the file 
			// sanitize each line
			// save line into an array (one csv line per student)
			// section id matches section chosen in form
			// check name and student id match database
			// save each student that is ok
			// output errors or list of students that could not be added
			/**
			$success = $this->dropStudent($student_id, $section_id, 
										$mdb_control, $error_array);
			**/
			$success = false;
			$error_array[] = "The mulit-student drop feature is not yet available";
		}
		
		return $success;
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


	public function getStudentID()
	{
		$student_id = "";
		
		if (isset($_POST['student_id']))
		{
			$student_id = $_POST['student_id']; 
		}
		else if (isset($_GET['student_id']))
		{
			$student_id = $_GET['student_id']; 
		}
		
		return $student_id;
	}
	
	
	
}

?>