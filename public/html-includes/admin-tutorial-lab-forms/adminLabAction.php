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
					$success = $this->addTutorialLab("add", $mdb_control, $error_array);
				break;
				
				case "edit":
					$success = $this->addTutorialLab("edit", $mdb_control, $error_array);
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
	
	
	public function addTutorialLab($action_type, $mdb_control, &$error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("tutorial_lab");
		$filepath = "";
		$uploads_dir = "";
		$tutorial_lab = new Tutorial_Lab();
		$files_uploaded_ok = true;
		
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
				
		$ok = $this->check4Duplicates($action_type, $controller, $web_link, 
										$lab_name, $error_array);
		if(!$ok) { $success = false; }
		
		
		// save the new tutorial lab to the database
		if($success && ($action_type == "add"))
		{					
			$tutorial_lab->initialize(null, $lab_name, $web_link, 
									$lab_status, $introduction);	
			
			// files not yet uploaded
			$tutorial_lab->initializePart2($prerequisites, $key_topics, null, null, null);
							
			$success = $controller->saveNew($tutorial_lab);
			
			if($success )
			{
				$id = $tutorial_lab->get_tutorial_lab_id();
				$year = date("Y");
				$filepath = "tutorial_lab/$year/id_$id";
				$uploads_dir = "attachments/$filepath";					
				$tutorial_lab->set_filepath($filepath);
				$controller->updateAttribute($tutorial_lab, "filepath");
			}
			
			if($success)
			{			
				$files_uploaded_ok = $this->uploadFiles($tutorial_lab, 
						$controller, $uploads_dir, $mdb_control, $error_array);
			}			
		}
		
		
		// save the new tutorial lab to the database
		if($success && ($action_type == "edit"))
		{			
			$lab_id = $_POST["tutorial_lab_id"];
			
			$tutorial_lab = $controller->getByPrimaryKey("tutorial_lab_id", $lab_id);
			
			// set the text fields with the new data
			$tutorial_lab->initialize($lab_id, $lab_name, $web_link, 
									$lab_status, $introduction);	
			$tutorial_lab->set_prerequisites($prerequisites);
			$tutorial_lab->set_key_topics($key_topics);			
			
			$success = $controller->updateAll($tutorial_lab);
			
			// get the original file path to update the files
			$filepath = $tutorial_lab->get_filepath();
			$uploads_dir = "attachments/$filepath";
			
			if($success)
			{			
				$files_uploaded_ok = $this->updateFiles($tutorial_lab, 
						$controller, $uploads_dir, $mdb_control, $error_array);
			}
		}		
		
		
		if(!$files_uploaded_ok)
		{ 
			$error_array[] = "The new Tutorial Lab was saved, but without 
							some of the possible file attachments.
							Please use Edit Tutorial Lab to add files later.";
			$success = false; 
		}
			
		return $success;
	}
	
	
	public function check4Duplicates($action_type, $lab_controller, 
								$web_link, $lab_name, &$error_array)
	{
		$success = true;
		
		if(is_null($lab_name) || is_null($web_link))
		{
			$error_array[] = "The Tutorial Lab must have a name and web link.";
			return false;
		}
		
		if($action_type == "add")
		{
			// the lab_name and web_link must be unique
			$links = array();
			$links = $lab_controller->getByAttribute("tutorial_lab_web_link", $web_link);
			$names = array();
			$names = $lab_controller->getByAttribute("tutorial_lab_name", $lab_name);
			
			if(!empty($links) || !empty($names))
			{
				$error_array[] = "The lab name and web link must be unique
									to this particular tutorial lab.";
				$success = false;
			}
		}
		
		if($action_type == "edit")
		{
			// the lab_name and web_link must be unique
			$tutorial_lab_id = $_POST["tutorial_lab_id"];
			$links = array();
			$links = $lab_controller->getByAttribute("tutorial_lab_web_link", $web_link);
			$names = array();
			$names = $lab_controller->getByAttribute("tutorial_lab_name", $lab_name);
			
			if(!empty($links))
			{
				$id = $links[0]->get_tutorial_lab_id();
				if($id != $tutorial_lab_id)
				{
					$error_array[] = "The lab name must be unique
										to this particular tutorial lab.";
					$success = false;
				}
			}
			
			if(!empty($names))
			{
				$id = $names[0]->get_tutorial_lab_id();
				if($id != $tutorial_lab_id)
				{
					$error_array[] = "The web link must be unique
										to this particular tutorial lab.";
					$success = false;
				}
			}
		}
		
		return $success;
	}
	
	
	public function uploadFiles($tutorial_lab, $lab_controller, $uploads_dir, 
										$mdb_control, &$error_array)
	{		
		$success = true;
		$fileAction = new FileAction();		
		$key_equations = "";
		$description = "";
		$instructions = "";
		
		if(isset($_FILES["key_equations"]) && 
				($_FILES["key_equations"]['error'] == UPLOAD_ERR_OK))
		{
			$key_equations = $fileAction->tutorialLabFileUpload($uploads_dir, 
								"key_equations", $mdb_control, $error_array);
								
			if(!empty($key_equations))
			{
				$tutorial_lab->set_key_equations($key_equations);
				$lab_controller->updateAttribute($tutorial_lab, "key_equations");
			}
			else
			{
				$success = false;
				$error_array[] = "Key Equations file could not be uploaded.";
			}
		}
			
			
		if(isset($_FILES["description"]) && 
				($_FILES["description"]['error'] == UPLOAD_ERR_OK))
		{
			$description = $fileAction->tutorialLabFileUpload($uploads_dir, 
								"description", $mdb_control, $error_array);
								
			if(!empty($description))
			{
				$tutorial_lab->set_description($description);
				$lab_controller->updateAttribute($tutorial_lab, "description");
			}
			else
			{
				$success = false;
				$error_array[] = "Description file could not be uploaded.";
			}
		}
		
		
		if(isset($_FILES["instructions"]) && 
				($_FILES["instructions"]['error'] == UPLOAD_ERR_OK))
		{
			$instructions = $fileAction->tutorialLabFileUpload($uploads_dir, 
								"instructions", $mdb_control, $error_array);
								
			if(!empty($instructions))
			{
				$tutorial_lab->set_instructions($instructions);
				$lab_controller->updateAttribute($tutorial_lab, "instructions");
			}
			else
			{
				$success = false;
				$error_array[] = "Instructions file could not be uploaded.";
			}
		}	

		return $success;
	}
	
	
	public function updateFiles($tutorial_lab, $lab_controller, $uploads_dir, 
										$mdb_control, &$error_array)
	{		
		$success = true;
		$fileAction = new FileAction();	
		$key_equations_2 = "";
		$description_2 = "";
		$instructions_2 = "";
		
		if(isset($_FILES["key_equations_2"]) && 
				($_FILES["key_equations_2"]['error'] == UPLOAD_ERR_OK))
		{
			$filename = $tutorial_lab->get_key_equations();
			
			if(!empty($filename))
			{
				$fileAction->deleteFile($uploads_dir, $filename);
				$tutorial_lab->set_key_equations(null);
				$lab_controller->updateAttribute($tutorial_lab, "key_equations");
			}
			
			$key_equations_2 = $fileAction->tutorialLabFileUpload($uploads_dir, 
								"key_equations_2", $mdb_control, $error_array);
								
			if(!empty($key_equations_2))
			{
				$tutorial_lab->set_key_equations($key_equations_2);
				$lab_controller->updateAttribute($tutorial_lab, "key_equations");
			}
			else
			{
				$success = false;
				$error_array[] = "Key Equations file could not be updated.";
			}
		}
		
		
		if(isset($_FILES["description_2"]) && 
				($_FILES["description_2"]['error'] == UPLOAD_ERR_OK))
		{
			$filename = $tutorial_lab->get_description();
			
			if(!empty($filename))
			{
				$fileAction->deleteFile($uploads_dir, $filename);
				$tutorial_lab->set_description(null);
				$lab_controller->updateAttribute($tutorial_lab, "description");
			}
			
			$description_2 = $fileAction->tutorialLabFileUpload($uploads_dir, 
								"description_2", $mdb_control, $error_array);
								
			if(!empty($description_2))
			{
				$tutorial_lab->set_description($description_2);
				$lab_controller->updateAttribute($tutorial_lab, "description");
			}
			else
			{
				$success = false;
				$error_array[] = "Description file could not be updated.";
			}
		}
		
		
		if(isset($_FILES["instructions_2"]) && 
				($_FILES["instructions_2"]['error'] == UPLOAD_ERR_OK))
		{
			$filename = $tutorial_lab->get_instructions();
			
			if(!empty($filename))
			{
				$fileAction->deleteFile($uploads_dir, $filename);
				$tutorial_lab->set_instructions(null);
				$lab_controller->updateAttribute($tutorial_lab, "instructions");
			}
			
			$instructions_2 = $fileAction->tutorialLabFileUpload($uploads_dir, 
								"instructions_2", $mdb_control, $error_array);
								
			if(!empty($instructions_2))
			{
				$tutorial_lab->set_instructions($instructions_2);
				$lab_controller->updateAttribute($tutorial_lab, "instructions");
			}
			else
			{
				$success = false;
				$error_array[] = "Instructions file could not be updated.";
			}
		}	
		

		return $success;
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
