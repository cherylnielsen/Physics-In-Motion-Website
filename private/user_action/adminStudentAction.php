<?php

class adminStudentAction
{
	public function __construct() {}
	
	
	public function processForm($mdb_control)
	{	
		$returnURL = "admin-home-page.php";
		$error_array = array();
		$success = true;
		$action = "";
		$section_id = "";
		$result = array();
		
		if(isset($_POST["action_type"]))
		{
			$action = $_POST["action_type"];
			
			switch ($action)
			{
				case "add":
				
					if(isset($_FILES["attachments"]) && ($_FILES["attachments"]["error"] == UPLOAD_ERR_OK))
					{
						$success = $this->addDropMultiStudents("add", $mdb_control, $error_array);
					}
					else
					{
						$section_id = $_POST["section_id"];
						$student_id = $_POST["student_id"];						
						$success = $this->addStudent($student_id, $section_id, 
													$mdb_control, $error_array);
					}
					
				break;
				
				case "drop":
				
					if(isset($_FILES["attachments"]) && ($_FILES["attachments"]["error"] == UPLOAD_ERR_OK))
					{
						$success = $this->addDropMultiStudents("drop", $mdb_control, $error_array);
					}
					else
					{
						$section_id = $_POST["section_id"];
						$student_id = $_POST["student_id"];
						$success = $this->dropStudent($student_id, $section_id, 
													$mdb_control, $error_array);
					}
					
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
			
			if(strcmp($action, "add") == 0)
			{
				$form_errors .= "<p>The students have been added to Section $section_id.</p>";
			}			
			else if(strcmp($action, "drop") == 0)
			{
				$form_errors .= "<p>The students have been dropped from Section $section_id.</p>";
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
	
	
	// dose not give an error if the student was already added to the section
	public function addStudent($student_id, $section_id, $mdb_control, &$error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("section_student");

		if(!isset($controller))
		{
			$success = false;
			$error_array[] = "error accessing database controller";
		}
		
		$section_student = new Section_Student();
		$section_student = $controller->getByPrimaryKeys("section_id", $section_id, 
													"student_id", $student_id);
													
		// if student is already in that section
		if(isset($section_student))
		{
			$success = false;
			$dropped = $section_student->get_dropped_section();
			if($dropped)
			{
				$error_array[] = "the student $student_id was previously 
										dropped from section $section_id";
			}
			else
			{
				$error_array[] = "the student $student_id was previously 
										added to section $section_id";
			}	
		}
		else
		{
			$section_student = new Section_Student();
			$section_student->initialize($section_id, $student_id);
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
			$section_student = $controller->getByPrimaryKeys("section_id", $section_id, 
														"student_id", $student_id);
			if(isset($section_student))
			{	
				$dropped = $section_student->get_dropped_section();
				if($dropped)
				{
					$success = false;
					$error_array[] = "the student $student_id was previously 
											dropped from section $section_id";
				}
				else
				{
					// setting dropped_section = true
					$section_student->set_dropped_section(true);
					$sucess = $controller->updateAttribute($section_student, "dropped_section");
				}
			}
			else
			{
				$success = false;
				$error_array[] = "student $student_id was not found in section $section_id";
			}
		}
		else
		{
			$success = false;
			$error_array[] = "error accessing database controller";
		}
		
		return $success;
	}
	
	
	public function addDropMultiStudents($action_type, $mdb_control, &$error_array)
	{
		$success = true;
		$total_success = true;
			
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
			$controller;
			
			$section;
			$section_id;
			$section_name;
			
			$student;
			$student_id;
			$first_name;
			$last_name;
			
			if(($dataArray != false) && (count($dataArray) > 0))
			{					
				foreach($dataArray as $dataLine)
				{					
					$success = true;
					$line_size = count($dataLine);
					
					if(count($dataLine) != 5)
					{
						$success = false;
						$error_array[] = "Line $line_number has an 
											incorrect number of data items.";
					}
					else
					{						
						$section_id = $this->sanitizeTextInput($dataLine[0]);
						$section_name = $this->sanitizeTextInput($dataLine[1]);
						$student_id = $this->sanitizeTextInput($dataLine[2]);
						$first_name = $this->sanitizeTextInput($dataLine[3]);
						$last_name = $this->sanitizeTextInput($dataLine[4]);
					}

					if((strlen($section_id) == 0) || (strlen($section_name) == 0) 
						|| (strlen($student_id) == 0) || (strlen($first_name) == 0) 
							|| (strlen($last_name) == 0))
					{
						$success = false;
						$error_array[] = "Line $line_number has incorrectly formated data.";
					}
					
					if(!$this->filterTextInput($section_name, $error_array) || 
						!$this->filterTextInput($first_name, $error_array) || 
							!$this->filterTextInput($last_name, $error_array)) 
					{ 
						$success = false;
						$error_array[] = "Line $line_number has incorrectly formated data.";
					}
					
					$ok_section = $this->checkSectionIDNameMatch($section_id, 
									$section_name, $mdb_control, $error_array);
					
					$ok_student = $this->checkStudentIDNameMatch($student_id, 
							$first_name, $last_name, $mdb_control, $error_array);
					
					if(!$ok_section || !$ok_student)
					{
						$success = false;
					}
					
					if("add" == $action_type)
					{
						if($success)
						{
							$success = $this->addStudent($student_id, $section_id, 
														$mdb_control, $error_array);
						}
						
						if(!$success)
						{
							$error_array[] = "Student at line $line_number could not be added.";
							$total_success = false;
						}
					}
					
					if("drop" == $action_type)
					{
						if($success)
						{
							$success = $this->dropStudent($student_id, $section_id, 
														$mdb_control, $error_array);
						}
						
						if(!$success)
						{
							$error_array[] = "Student at line $line_number could not be dropped.";
							$total_success = false;
						}
					}
					
					$line_number++;
				}
			}
		}
				
		return $total_success;
	}
	
	
	public function checkSectionIDNameMatch($section_id, $section_name, 
											$mdb_control, &$error_array)
	{
		$success = true;
		
		if(!is_numeric($section_id))
		{ 
			$success = false;
			$error_array[] = "Student at line $line_number could not be added,
								because the student id is not an integer.";
		}
		else
		{
			$controller = $mdb_control->getController("section");
			$section = $controller->getByPrimaryKey("section_id", $section_id);
			
			if(!isset($section))
			{
				$success = false;
				$error_array[] = "Student at line $line_number could not be added,
							because the section id was not found in the database.";
			}
			else
			{
				$name = $section->get_section_name();
				
				if((strcmp($name, $section_name) != 0))
				{
					$success = false;
					$error_array[] = "Student at line $line_number could not be added,
										because the section name did not match the 
										section id found in the database.";
				}
			}
		}
		
		return $success;
	}
	
	
	public function checkStudentIDNameMatch($student_id, $first_name, $last_name, 
											$mdb_control, &$error_array)
	{
		$success = true;
		
		if(!is_numeric($student_id))
		{ 
			$success = false;
			$error_array[] = "Student at line $line_number could not be added,
								because the student id is not an integer.";
		}
		else
		{
			$controller = $mdb_control->getController("member");
			$student = $controller->getByPrimaryKey("member_id", $student_id);
			
			if(!isset($student))
			{
				$success = false;
				$error_array[] = "Student at line $line_number could not be added,
							because the student id was not found in the database.";
			}
			else
			{
				$first = $student->get_first_name();
				$last = $student->get_last_name();
				
				if((strcmp($first, $first_name) != 0) || (strcmp($last, $last_name) != 0))
				{
					$success = false;
					$error_array[] = "Student at line $line_number could not be added,
										because the student name did not match the 
										student id found in the database.";
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