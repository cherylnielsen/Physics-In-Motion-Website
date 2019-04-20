<?php

class adminSectionAction
{
	public function __construct() {}
	
	
	public function processForm($mdb_control)
	{	
		$error_array = array();
		$success = true;
		$action = "";
		$section_id = "";
		
		if(isset($_POST["action_type"]))
		{
			$action = $_POST["action_type"];
			
			switch ($action)
			{
				case "add":
				
					if(isset($_FILES["attachments"]) && ($_FILES["attachments"]["error"] == UPLOAD_ERR_OK))
					{
						$success = $this->addMultiSections($mdb_control, $error_array);
					}
					else
					{
						$success = $this->addSection($mdb_control, $error_array);
					}
					
				break;
				
				case "drop":
				
					if(isset($_FILES["attachments"]) && ($_FILES["attachments"]["error"] == UPLOAD_ERR_OK))
					{
						$success = $this->dropMultiSections($mdb_control, $error_array);
					}
					else
					{
						$section_id = $_POST["section_id"];
						$success = $this->dropSection($mdb_control, $section_id, $error_array);
					}
					
				break;
				
				case "edit":
					$section_id = $_POST["section_id"];
					$success = $this->editSection($mdb_control, $section_id, $error_array);
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
				$form_errors .= "<h2>The new sections have been added.</h2>";
			}			
			else if(strcmp($action, "drop") == 0)
			{
				$form_errors .= "<h2>The sections have been dropped.</h2>";
			}
			else if(strcmp($action, "edit") == 0)
			{
				$form_errors .= "<h2>Section $section_id has been updated.</h2>";
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
	
	
	public function editSection($mdb_control, $section_id, $error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("section");
		
		if(isset($controller))
		{
			$section_name = $_POST["section_name"];
			$professor_id = $_POST["professor_id"];
			$start_date = $_POST["start_date"];
			$end_date = $_POST["end_date"];
			$description = $_POST["description"];	
			
			$section = new Section();			
			$section->initialize($section_id, $section_name, $professor_id, 
									$start_date, $end_date, $description);
			
			$sucess = $controller->updateAll($section);
		}
		
		return $success;
	}	
	
	
	public function addSection($mdb_control, &$error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("section");
		
		if(isset($controller))
		{
			$section_name = $_POST["section_name"];
			$professor_id = $_POST["professor_id"];
			$start_date = $_POST["start_date"];
			$end_date = $_POST["end_date"];
			$description = $_POST["description"];			
			$section = new Section();			
			$section->initialize(null, $section_name, $professor_id, 
										$start_date, $end_date, $description);
			
			$sucess = $controller->saveNew($section);
		}
		
		return $success;
	}
	
	
	public function dropSection($mdb_control, $section_id, &$error_array)
	{
		$success = true;		
		$section_name = $_POST["section_name"];
		$section_controller = $mdb_control->getController("section");
		$section = new Section();
		$section = $section_controller->getByPrimaryKey("section_id", $section_id);
		$controller = $mdb_control->getController("section_student");
		$section_students = $controller->getByAttribute("section_id", $section_id);

		// if section has students do not delete it
		if(count(section_students) > 0)
		{
			$student_total = count(section_students);
			
			for($i = 0; $i < count(section_students); $i++)
			{
				$dropped = $section_students[$i]->get_dropped_section();
				if($dropped) { $student_total--; }
			}
			
			if($student_total > 0)
			{
				$error_array[] = "Section $section_id : $section_name has active 
									students, so it cannot be deleted.";
				return false;
			}
			else
			{
				for($i = 0; $i < count(section_students); $i++)
				{
					$sectionStudent = $section_students[$i];
					$controller->deleteFromDatabase($sectionStudent);
				}
			}
		}
		
		$sucess = $section_controller->deleteFromDatabase($section);
		
		return $success;
	}
	
	
	public function addMultiSections($mdb_control, &$error_array)
	{
		$success = true;
		
		$controller = $mdb_control->getController("section");
		
		if(isset($controller) && isset($_FILES["attachments"]))
		{
			// each file line = section name, start date, end date, description
			// get the file, but do not save it?
			// read the file, sanitize each line
			// save line into an array (one csv line per student)
			// section id matches section chosen in form
			// check name and student id match database
			// save each student that is ok
			// output errors or list of students that could not be added
			
			// call $ok = $this->addSection($mdb_control, &$error_array);
			$success = false;
			$error_array[] = "The mulit-section add feature is not yet available";
		}
		
		return $success;
	}
	
	
	public function dropMultiSections($mdb_control, &$error_array)
	{
		$success = true;
		
		$controller = $mdb_control->getController("section");
		
		if(isset($controller) && isset($_FILES["attachments"]))
		{
			// each file line = section id, student id, first name, last name
			// get the file, but do not save it?
			// read the file, sanitize each line
			// save line into an array (one csv line per student)
			// section id matches section chosen in form
			// check name and student id match database
			// save each student that is ok
			// output errors or list of students that could not be added
			
			// call $ok = $this->dropSection($mdb_control, $section_id, &$error_array);		
			$success = false;
			$error_array[] = "The mulit-section delete feature is not yet available";
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
	
	
	public function getProfessorID()
	{
		$professor_id = "";
		
		if (isset($_POST['professor_id']))
		{
			$professor_id = $_POST['professor_id']; 
		}
		else if (isset($_GET['professor_id']))
		{
			$professor_id = $_GET['professor_id']; 
		}
		
		return $professor_id;
	}
	
	
	public function getProfessorName()
	{
		$professor_name = "";
		
		if (isset($_POST['professor_name']))
		{
			$professor_name = $_POST['professor_name']; 
		}
		else if (isset($_GET['professor_name']))
		{
			$professor_name = $_GET['professor_name']; 
		}
		
		return $professor_name;
	}
	
	
	public function getStartDate()
	{
		$start_date = "";
		
		if (isset($_POST['start_date']))
		{
			$start_date = $_POST['start_date']; 
		}
		else if (isset($_GET['start_date']))
		{
			$start_date = $_GET['start_date']; 
		}
		
		return $start_date;
	}

	
	public function getEndDate()
	{
		$end_date = "";
		
		if (isset($_POST['end_date']))
		{
			$end_date = $_POST['end_date']; 
		}
		else if (isset($_GET['end_date']))
		{
			$end_date = $_GET['end_date']; 
		}
		
		return $end_date;
	}
	
	
	public function getDescription()
	{
		$description = "";
		
		if (isset($_POST['description']))
		{
			$description = $_POST['description']; 
		}
		else if (isset($_GET['description']))
		{
			$description = $_GET['description']; 
		}
		
		return $description;
	}
	
	
	
}

?>