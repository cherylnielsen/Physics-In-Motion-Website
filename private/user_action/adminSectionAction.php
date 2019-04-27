<?php

class adminSectionAction
{	
	public function __construct() 
	{
	}
	
	
	public function processForm($mdb_control)
	{	
		$returnURL = "admin-home-page.php";
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
				
					if(isset($_FILES['attachments']) && 
						($_FILES['attachments']['error'] == UPLOAD_ERR_OK))
					{
						$success = $this->addMultiSections($mdb_control, $error_array);
					}
					else
					{
						$success = $this->addSection($mdb_control, $error_array);
					}
					
				break;
				
				case "drop":
				
					if(isset($_FILES['attachments']) && 
						$_FILES['attachments']['error'] == UPLOAD_ERR_OK)
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

			$homeURL = "http://localhost/Physics-in-Motion/" . $returnURL;
			
			echo "<script type='text/javascript'>
					window.location.href = $homeURL;
				</script>";
			echo "<h2 class='center'>$form_errors</h2>";
			
			exit();
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
	
	
	public function editSection($mdb_control, $section_id, &$error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("section");
		
		if(isset($controller))
		{
			$section_id = $_POST["section_id"];
			$professor_id = $_POST["professor_id"];
			$start_date = $_POST["start_date"];
			$end_date = $_POST["end_date"];
			
			if(strlen($section_id) == 0)
			{
				$error_array[] = "Please select a section.";
				$success = false;
			}
			
			if(strlen($professor_id) == 0)
			{
				$error_array[] = "Please select a professor.";
				$success = false;
			}
			
			if((strlen($start_date) == 0) || (strlen($start_date) == 0))
			{
				$error_array[] = "Please select a start date and end date.";
				$success = false;
			}			
			
			$start_date = date ("Y-m-d", strtotime($start_date));
			$end_date = date ("Y-m-d", strtotime($end_date));
			
			// text inputs
			$section_name = $_POST["section_name"];
			$description = $_POST["description"];	
			
			// only section name and description are text inputs so 
			// they need to be safety filtered 
			$section_name = $this->sanitizeTextInput($section_name);
			$description = $this->sanitizeTextInput($description);
			
			if(strlen($section_name) == 0)
			{
				$error_array[] = "Please enter a section name.";
				$success = false;
			}
			
			if(strlen($description) == 0)
			{
				$error_array[] = "Please enter a section description.";
				$success = false;
			}
			
			if(!$this->filterTextInput($section_name, $error_array)) 
			{ 
				$success = false;
				$error_array[] = "Section at line $line_number could not be added, 
									due to incorrectly formated section name.";
			}
			
			if(!$this->filterTextInput($description, $error_array)) 
			{ 
				$success = false;
				$error_array[] = "Section at line $line_number could not be added, 
									due to incorrectly formated section description.";
			}
			
			if($success)
			{
				$section = new Section();			
				$section->initialize($section_id, $section_name, $professor_id, 
									$start_date, $end_date, $description);
			
				$success = $controller->updateAll($section);
			}
		}
		
		return $success;
	}	
	
	
	public function addSection($mdb_control, &$error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("section");
		
		if(isset($controller))
		{
			$professor_id = $_POST["professor_id"];
			$start_date = $_POST["start_date"];
			$end_date = $_POST["end_date"];
			
			if(strlen($professor_id) == 0)
			{
				$error_array[] = "Please select a professor.";
				$success = false;
			}
			
			if((strlen($start_date) == 0) || (strlen($end_date) == 0))
			{
				$error_array[] = "Please select a start date and end date.";
				$success = false;
			}			
			
			$start_date = date ("Y-m-d", strtotime($start_date));
			$end_date = date ("Y-m-d", strtotime($end_date));
					
			// text inputs
			$section_name = $_POST["section_name"];
			$description = $_POST["description"];	

			// only section name and description are text inputs so 
			// they need to be safety filtered 
			$section_name = $this->sanitizeTextInput($section_name);
			$description = $this->sanitizeTextInput($description);
			
			if(strlen($section_name) == 0)
			{
				$error_array[] = "Please enter a section name.";
				$success = false;
			}
			
			if(strlen($description) == 0)
			{
				$error_array[] = "Please enter a section description.";
				$success = false;
			}
			
			if(!$this->filterTextInput($section_name, $error_array)) 
			{ 
				$success = false;
				$error_array[] = "Section at line $line_number could not be added, 
									due to incorrectly formated section name.";
			}
			
			if(!$this->filterTextInput($description, $error_array)) 
			{ 
				$success = false;
				$error_array[] = "Section at line $line_number could not be added, 
									due to incorrectly formated section description.";
			}
			
			if($success)
			{
				$section = new Section();			
				$section->initialize(null, $section_name, $professor_id, 
								$start_date, $end_date, $description);
								
				$success = $controller->saveNew($section);
			}
		}
		
		return $success;
	}
	
	
	public function dropSection($mdb_control, $section_id, &$error_array)
	{
		$success = true;		
		$sec_controller = $mdb_control->getController("section");
		$section = new Section();
		$section = $sec_controller->getByPrimaryKey("section_id", $section_id);
		
		if(!isset($section))
		{
			return false;
		}
		
		$section_name = $section->get_section_name();
		$controller = $mdb_control->getController("section_student");
		$section_students = $controller->getByAttribute("section_id", $section_id);
			
		// if section has students do not delete it
		if(isset($section_students))
		{			
			$student_total = count($section_students);
			
			for($i = 0; $i < count($section_students); $i++)
			{
				$dropped = $section_students[$i]->get_dropped_section();
				if($dropped) { $student_total--; }
			}
			
			if($student_total > 0)
			{
				$error_array[] = "Section $section_id : $section_name : has active 
									students, so it cannot be deleted.";
				return false;
			}
			else
			{
				for($i = 0; $i < count($section_students); $i++)
				{
					$sectionStudent = $section_students[$i];
					$controller->deleteFromDatabase($sectionStudent);
				}
			}
		}
		
		if(isset($section))
		{
			$success = $sec_controller->deleteFromDatabase($section);
		}
		else
		{
			$success = false;
			$error_array[] = "";
		}
		
		return $success;
	}
	
	
	public function addMultiSections($mdb_control, &$error_array)
	{
		$success = true;
		$section_name = "";
		$professor_id = "";
		$first_name = "";
		$last_name = "";
		$description = "";
		$start_date = "";
		$end_date = "";
		
		if(isset($_FILES["attachments"]))
		{
			$fileAction = new FileAction();
			$dataArray = $fileAction->uploadCSVfile($error_array);
			
			if($dataArray == false)
			{
				$error_array[] = "Sections could not be added due to error reading file.";
				return false;
			}
			
			$array_size = count($dataArray);
			$line_number = 0;
			
			if(($dataArray != false) && (count($dataArray) > 0))
			{				
				foreach($dataArray as $dataLine)
				{
					if(count($dataLine) != 7)
					{
						$success = false;
						$error_array[] = "Section at line $line_number could not be dropped, 
										due to incorrect number of data items.";
					}
					else
					{						
						$section_name = $this->sanitizeTextInput($dataLine[0]);
						$professor_id = $this->sanitizeTextInput($dataLine[1]);
						$first_name = $this->sanitizeTextInput($dataLine[2]);
						$last_name = $this->sanitizeTextInput($dataLine[3]);
						$description = $this->sanitizeTextInput($dataLine[6]);
						$start_date = $this->sanitizeTextInput($dataLine[4]);
						$end_date = $this->sanitizeTextInput($dataLine[5]);
					}
					
					if((strlen($section_name) == 0) || (strlen($professor_id) == 0) 
						|| (strlen($first_name) == 0) || (strlen($last_name) == 0) 
						|| (strlen($description) == 0))
					{
						$success = false;
						$error_array[] = "Section at line $line_number could not be added, 
											due to incorrectly formated data.";
					}
					
					if(!$this->filterTextInput($section_name, $error_array) || 
						!$this->filterTextInput($first_name, $error_array) || 
						!$this->filterTextInput($last_name, $error_array) || 
						!$this->filterTextInput($description, $error_array)) 
					{ 
						$success = false;
						$error_array[] = "Section at line $line_number could not be added, 
											due to incorrectly formated data.";
					}
										
					if((strlen($start_date) == 0) || (strlen($end_date) == 0))
					{
						$success = false;
						$error_array[] = "Section at line $line_number could not be added, 
											due to incorrectly formated start or end dates.";
					}
					else
					{
						$start_date = date ("Y-m-d", strtotime($start_date));
						$end_date = date ("Y-m-d", strtotime($end_date));
						
						if(!$start_date || !$end_date)
						{
							$success = false;
							$error_array[] = "Section at line $line_number could not be added, 
												due to incorrectly formated start or end dates.";
						}
					}
					
					$controller;
					$professor;
					
					if(!is_numeric($professor_id))
					{ 
						$success = false;
						$error_array[] = "Section at line $line_number could not be added,
											because the professor id is not an integer.";
					}
					else
					{
						$controller = $mdb_control->getController("member");
						$professor = $controller->getByPrimaryKey("member_id", $professor_id);
					}
					
					if(!isset($professor))
					{
						$success = false;
						$error_array[] = "Section at line $line_number could not be added,
											because the professor id was not found in the database.";
					}
					else
					{
						$first = $professor->get_first_name();
						$last = $professor->get_last_name();
						
						if((strcmp($first, $first_name) != 0) || (strcmp($last, $last_name) != 0))
						{
							$success = false;
							$error_array[] = "Section at line $line_number could not be added,
												because the professor name did not match the 
												professor id found in the database.";
						}
					}
					
					if($success)
					{
						$section = new Section();			
						$section->initialize(null, $section_name, $professor_id, 
									$start_date, $end_date, $description);
						$controller = $mdb_control->getController("section");
						
						$success = $controller->saveNew($section);
					}
					
					if(!$success)
					{
						$success = false;
						$error_array[] = "Section at line $line_number could not be added.";
					}
					
					$line_number++;
				}
			}
		}
		
		return $success;
	}
	
	
	public function dropMultiSections($mdb_control, &$error_array)
	{
		$success = true;	
		
		if(isset($_FILES["attachments"]))
		{
			$fileAction = new FileAction();
			$dataArray = $fileAction->uploadCSVfile($error_array);
			$line_number = 0;
			$controller;
			$section;
			$section_id;
			$section_name;
			
			if(($dataArray != false) && (count($dataArray) > 0))
			{
				foreach($dataArray as $dataLine)
				{					
					if(count($dataLine) != 2)
					{
						$success = false;
						$error_array[] = "Section at line $line_number could not be dropped, 
										due to incorrect number of data items.";
					}
					else
					{
						$section_id = $this->sanitizeTextInput($dataLine[0]);
						$section_name = $this->sanitizeTextInput($dataLine[1]);
						
						if((strlen($section_id) == 0) || (strlen($section_name) == 0))
						{
							$success = false;
							$error_array[] = "Section at line $line_number could not be 
											dropped, due to incorrectly formated data.";
						}
					}
					
					if($success)
					{
						$controller = $mdb_control->getController("section");
						$section = $controller->getByPrimaryKey("section_id", $section_id);
						
						if(isset($section))
						{							
							if($section->get_section_name() != $section_name)
							{
								$success = false;
								$error_array[] = "Section at line $line_number could not be dropped,
											because section name did not match the section number 
											in the database.";
							}
						}
						else
						{
							$success = false;
							$error_array[] = "Section at line $line_number could not be dropped,
										because section number was not found in the database.";
						}
					}
					
					if(isset($section))
					{
						$success = $this->dropSection($mdb_control, $section_id, $error_array);
					}
					
					if(!$success)
					{
						$success = false;
						$error_array[] = "Section at line $line_number could not be dropped.";
					}
					
					$line_number++;
				}
			}
		}
		
		return $success;
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