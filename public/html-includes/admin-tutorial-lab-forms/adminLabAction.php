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
					$error_array[] = "Sorry, unknown action type, the request could not be processed.";
					$success = false;
			}
		}
		else
		{
			$error_array[] = "Sorry, unknown action type, the request could not be processed.";
			$success = false;
		}
		
		if($success)
		{	
			$form_errors = "<h2>SUCCESS: </h2>";
			$form_errors .= "<p>The new Tutorial Lab has been saved.</p>";
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
	
	
	public function addTutorialLab($mdb_control, &$error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("tutorial_lab");
		$filepath = "";
		
		if(!isset($controller))
		{
			$error_array[] = "Database controller error, the request 
								could not be processed.";
			return false;
		}		
		
		$lab_name = $this->filterInputData("tutorial_lab_name", $error_array);
		$web_link = $this->filterInputData("web_link", $error_array);
		$lab_status = $this->filterInputData("lab_status", $error_array);
		$introduction = $this->sanitizeTextInput($_POST["introduction"]);
		$prerequisites = $this->sanitizeTextInput($_POST["prerequisites"]);
		$key_topics = $this->sanitizeTextInput($_POST["key_topics"]);
		
		if( is_null($lab_status) || is_null($introduction) || 
			is_null($prerequisites) || is_null($key_topics))
		{
			$error_array[] = "The Tutorial Lab could not be added.";
			$success = false;
		}

		$status_values = array('New', 'Updated', 'Available', 'Development', 'Discontinued');
		
		if(!in_array($lab_status, $status_values))
		{
			$error_array[] = "Lab Status was not an allowed value.";
			$success = false;
		}
				
		if(is_null($lab_name) || is_null($web_link))
		{
			$error_array[] = "The Tutorial Lab must have a name and web link.";
			$success = false;
		}
		else
		{
			// lab_name and web_link must be unique
			$links = array();
			$links = $controller->getByAttribute("tutorial_lab_web_link", $web_link);
			$names = array();
			$names = $controller->getByAttribute("tutorial_lab_name", $lab_name);
			
			if(!empty($links) || !empty($names))
			{
				$error_array[] = "The lab name and web link must be unique
									to this particular tutorial lab.";
				$success = false;
			}
		}
					
		// file uploads are not required, in case the new lab is still under development
		$key_equations = null;
		$description = null;
		$instructions = null;
			
		// save the new tutorial lab to the database
		if($success)
		{
			$tutorial_lab = new Tutorial_Lab();	
		
			$tutorial_lab->initialize(null, $lab_name, $web_link, $lab_status, 
										$introduction);
						
			$tutorial_lab->initializePart2($prerequisites, $key_topics, $key_equations, 
										$description, $instructions);	
						
			$success = $controller->saveNew($tutorial_lab);
		}
		
		// set the filepath based on the new lab id
		if($success)
		{
			$id = $tutorial_lab->get_tutorial_lab_id();
			$year = date("Y");
			$filepath = "tutorial_lab/$year/id_$id";
			$uploads_dir = "attachments/$filepath";
			$tutorial_lab->set_filepath($filepath);
			$success = $controller->updateAttribute($tutorial_lab, "filepath");
		}
		
		$files_uploaded_ok = true;
		
		if($success)
		{			
			$ok = true;
			$key_equations = $this->uploadFile($uploads_dir, "key_equations", 
												$mdb_control, $error_array);
			$description = $this->uploadFile($uploads_dir, "description", 
												$mdb_control, $error_array);
			$instructions = $this->uploadFile($uploads_dir, "instructions", 
												$mdb_control, $error_array);
						
			if(!empty($key_equations))
			{
				$tutorial_lab->set_key_equations($key_equations);
				$ok = $controller->updateAttribute($tutorial_lab, "key_equations");
			}
			
			if(!$ok || empty($key_equations))
			{
				$files_uploaded_ok = false;
				$error_array[] = "No key equations file, or it could not be uploaded.";
			}
			
			if(!empty($description))
			{
				$tutorial_lab->set_description($description);
				$ok = $controller->updateAttribute($tutorial_lab, "description");
			}
			
			if(!$ok || empty($description))
			{
				$files_uploaded_ok = false;
				$error_array[] = "No description file, or it could not be uploaded.";
			}
			
			if(!empty($instructions))
			{
				$tutorial_lab->set_instructions($instructions);
				$ok = $controller->updateAttribute($tutorial_lab, "instructions");
			}
			
			if(!$ok || empty($instructions))
			{
				$files_uploaded_ok = false;
				$error_array[] = "No instructions file, or it could not be uploaded.";
			}			
		}		
			
		// date available is not required, this would be normally set when the 
		// lab first becomes available to members for use as an assignment
		if($success && isset($_POST["date_available"]))
		{
			// if date available put into mysql formate
			$date_available = $_POST["date_available"];
			if(!empty($date_available))
			{
				$date_available = date("Y-m-d", strtotime($date_available));
				$tutorial_lab->set_date_first_available($date_available);
				$success = $controller->updateAttribute($tutorial_lab, 
											"date_first_available");
			}
		}
				
		if($success) 
		{ 
			if(!$files_uploaded_ok)
			{ 
				$error_array[] = "The new Tutorial Lab was saved, but without 
								some of the possible file attachments.
								Please use Edit Tutorial Lab to add files later.";
				$success = false; 
			}
		}
		
		return $success;
	}
	
	
	public function editTutorialLab($mdb_control, $error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("tutorial_lab");
		
		if(isset($controller))
		{
			$tutorial_lab = new Tutorial_Lab();			
			$tutorial_lab->initialize();
			$tutorial_lab->initialize2();
			$success = $controller->updateAll($tutorial_lab);
		}
		
		return $success;
	}	
	
	
	public function uploadFile($uploads_dir, $data_type, 
								$mdb_control, &$error_array)
	{		
		$filename = null;
		$fileAction = new FileAction();
		
		if(isset($_FILES[$data_type]) && 
				($_FILES[$data_type]['error'] == UPLOAD_ERR_OK))
		{
			$filename = $fileAction->tutorialLabFileUpload($uploads_dir, 
						$data_type, $mdb_control, $error_array);
		}
		
		return $filename;
	}
	
	
	public function filterInputData($data_type, &$error_array)
	{
		$data = $this->sanitizeTextInput($_POST[$data_type]);
		
		if(strlen($data) == 0) 
		{ 
			$error_array[] = "Please enter a $data_type.";
			return null;
		}
		
		$ok = $this->filterTextInput($data, $error_array);
		
		if(!$ok)
		{ 
			$error_array[] = "$data_type is not properly formated.";
			return null;
		}
		
		return $data;		
	}
	
	
	public function sanitizeTextInput($text)
	{
		$text = strip_tags($text);
		$text = trim($text);
		$db_connect = get_db_connection();
		$text = mysqli_real_escape_string($db_connect, $text);
		
		return $text;
	}
	
	
	public function filterTextInput($text, &$error_array)
	{
		$success = true;
		
		if (!preg_match("/^[a-zA-Z0-9 .',()&_\-]*$/", $text)) 
		{
			$error_array[] =  "Names can only contain letters, numbers, spaces, 
					and the following characters .',-_&()";  
			$success = false;
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
