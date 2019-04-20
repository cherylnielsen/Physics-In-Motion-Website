<?php

class adminLabAction
{
	public function __construct() {}
	
	
	public function processForm($mdb_control, $returnURL)
	{	
		$error_array = array();
		$success = true;
		
		if(isset($_POST["action_type"]))
		{
			$action = $_POST["action_type"];
			
			switch ($action)
			{
				case "add":
					$success = $this->addTutorialLab($mdb_control, $error_array);
				break;
				
				case "edit":
					$section_id = $_POST["section_id"];
					$success = $this->editTutorialLab($mdb_control, $error_array);
				break;
				
				default:
					$error_array[] = "Sorry, action type unknown, the request could not be 
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
			header("Location: $url");
			exit();
		}
		else
		{
			$form_errors = "<h2>ERROR: </h2>";
			
			for($i = 0; $i < count($error_array); $i++)
			{
				$form_errors .= "<p>" . $error_array[$i] . "</p>";
			}
		}
		
		return $form_errors;
	}
	
	
	public function editTutorialLab($mdb_control, $error_array)
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
			
			$sucess = $controller->updateAll($section);
		}
		
		return $success;
	}	
	
	
	public function addTutorialLab($mdb_control, &$error_array)
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
	
	
	public function getLabStatusOptions()
	{
		$status = array("New", "Updated", "Available", "Development", "Discontinued");
		return $status;
	}
	
	
	public function getLabID()
	{
		$tutorial_lab_id = "";
		
		if (isset($_POST['tutorial_lab_id']))
		{
			$tutorial_lab_id = $_POST['tutorial_lab_id']; 
		}
		else if (isset($_GET['tutorial_lab_id']))
		{
			$tutorial_lab_id = $_GET['tutorial_lab_id']; 
		}
		
		return $tutorial_lab_id;
	}

	
	public function getLabName()
	{
		$tutorial_lab_name = "";
		
		if (isset($_POST['tutorial_lab_name']))
		{
			$tutorial_lab_name = $_POST['tutorial_lab_name']; 
		}
		else if (isset($_GET['tutorial_lab_name']))
		{
			$tutorial_lab_name = $_GET['tutorial_lab_name']; 
		}
		
		return $tutorial_lab_name;
	}
	
	
	public function getWebLink()
	{
		$web_link = "";
		
		if (isset($_POST['web_link']))
		{
			$web_link = $_POST['web_link']; 
		}
		else if (isset($_GET['web_link']))
		{
			$web_link = $_GET['web_link']; 
		}
		
		return $web_link;
	}
	
	
	public function getLabStatus()
	{
		$lab_status = "";
		
		if (isset($_POST['lab_status']))
		{
			$lab_status = $_POST['lab_status']; 
		}
		else if (isset($_GET['lab_status']))
		{
			$lab_status = $_GET['lab_status']; 
		}
		
		return $lab_status;
	}
	
	
	public function getIntroduction()
	{
		$introduction = "";
		
		if (isset($_POST['introduction']))
		{
			$introduction = $_POST['introduction']; 
		}
		else if (isset($_GET['introduction']))
		{
			$introduction = $_GET['introduction']; 
		}
		
		return $introduction;
	}

	
	public function getPrerequisites()
	{
		$prerequisites = "";
		
		if (isset($_POST['prerequisites']))
		{
			$prerequisites = $_POST['prerequisites']; 
		}
		else if (isset($_GET['prerequisites']))
		{
			$prerequisites = $_GET['prerequisites']; 
		}
		
		return $prerequisites;
	}
	
	
	public function getKeyTopics()
	{
		$key_topics = "";
		
		if (isset($_POST['key_topics']))
		{
			$key_topics = $_POST['key_topics']; 
		}
		else if (isset($_GET['key_topics']))
		{
			$key_topics = $_GET['key_topics']; 
		}
		
		return $key_topics;
	}
	
	
	public function getKeyEquations()
	{
		$key_equations = "";
		
		if (isset($_POST['key_equations']))
		{
			$key_equations = $_POST['key_equations']; 
		}
		else if (isset($_GET['key_equations']))
		{
			$key_equations = $_GET['key_equations']; 
		}
		
		return $key_equations;
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
	
	
	public function getInstructions()
	{
		$instructions = "";
		
		if (isset($_POST['instructions']))
		{
			$instructions = $_POST['instructions']; 
		}
		else if (isset($_GET['instructions']))
		{
			$instructions = $_GET['instructions']; 
		}
		
		return $instructions;
	}
	
	
	public function getDateAvailable()
	{
		$date_available = "";
		
		if (isset($_POST['date_available']))
		{
			$date_available = $_POST['date_available']; 
		}
		else if (isset($_GET['date_available']))
		{
			$date_available = $_GET['date_available']; 
		}
		
		return $date_available;
	}
	
	
	public function getFilepath()
	{
		$filepath = "";
		
		if (isset($_POST['filepath']))
		{
			$filepath = $_POST['filepath']; 
		}
		else if (isset($_GET['filepath']))
		{
			$filepath = $_GET['filepath']; 
		}
		
		return $filepath;
	}
	
}


?>
