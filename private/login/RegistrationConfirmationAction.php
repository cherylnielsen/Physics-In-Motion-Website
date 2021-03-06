<?php

class RegistrationConfirmationAction
{
	public function __construct() {}
	
	
	public function processForm($mdb_control, $returnURL)
	{
		$register = new RegisterUtilities();
		$error_array = array();
		$success = true;
		
		if(isset($_FILES["attachments"]) && ($_FILES["attachments"]["error"] == UPLOAD_ERR_OK))
		{
			$success = $this->confirmMultipleProfessors($register, $mdb_control, $error_array);
		}
		else if(isset($_POST['professor_id']) && isset($_POST['confirm_professor']))
		{
			$professor_id = $_POST['professor_id'];
			$success = $this->confirmRegistration($professor_id, $mdb_control, $error_array);
		}
		else if(isset($_POST['administrator_id']) && isset($_POST['confirm_administrator']))
		{
			$administrator_id = $_POST['administrator_id'];
			$success = $this->confirmRegistration($administrator_id, $mdb_control, $error_array);
			
			if($success)
			{
				$this->setAdminType($administrator_id, $mdb_control, $error_array);
			}
		}
		else
		{
			$success = false;
			$error_array[] = "The confirmation type was unknown.";
		}
		
		if($success)
		{
			$form_success = "<h2>SUCCESS: </h2>";
			$form_success .= "<p>The Members have been confirmed, 
						and their registrations are now complete.</p>";
								
			$homeURL = "http://localhost/Physics-in-Motion/" . $returnURL;
		
			echo "<script type='text/javascript'>
					window.location.href = $homeURL;
				</script>";
				
			echo "<h2 class='center'>$form_success</h2>";
			
			exit();
		}
		else
		{
			$form_errors = "<h2>ERROR: </h2>";
			
			foreach($error_array as $str)
			{
				$form_errors .= "<p>" . $str . "</p>";
			}
			
			$form_errors .= "<p>The members could not be confirmed.</p><br>";
		}
				
		$result = array();
		$result['success'] = $success;
		$result['form_errors'] = $form_errors;
		
		return $result;
	}
	
	
	public function confirmMultipleProfessors($register, $mdb_control, &$error_array)
	{
		$success = true;
		$total_success = true;
		$dataArray = array();
		$professor_id = ""; 
		$firstname = "";  
		$lastname = "";  
		$email = "";
		$school = "";  
		 
		 
		// get an array of professor data from the file
		if(isset($_FILES["attachments"]))
		{
			$fileAction = new FileAction();
			$dataArray = $fileAction->uploadCSVfile($error_array);
			
			if($dataArray == false)
			{
				$error_array[] = "The Professors could not be confirmed due 
									to an error reading the file.";
				return false;
			}
			
			$array_size = count($dataArray);
			$line_number = 0;
			
			if((count($dataArray) > 0))
			{				
				foreach($dataArray as $dataLine)
				{
					$line_number++;
					$success = true;
					
					if(count($dataLine) != 5)
					{
						$success = false;
						$error_array[] = "Professor at line $line_number could not 
							be confirmed, due to an incorrect number of data items.";
					}
					else
					{			
						$professor_id = $dataLine[0];
						// is $professor_id a number
						if(!is_numeric($professor_id))
						{
							$success = false;
							$error_array[] = "The ID for the Professor at line 
												$line_number is not a number";
						}							
						
						if($success)
						{
							$success = $this->validateProfessor($dataLine, $register, 
														$mdb_control, $error_array);
									
							if(!$success)
							{
								$error_array[] = "The information for the Professor at line 
													$line_number could not be validated";
							}
						}
												
						if($success)
						{
							$success = $this->confirmRegistration($professor_id, 
													$mdb_control, $error_array);
						}
						
						if(!$success)
						{
							$error_array[] = "The Professor at line $line_number could 
												not be confirmed";
							$total_success = false;
						}
					}
				}
			}
		}
		
		return $total_success;
	}
	
	
	public function confirmRegistration($member_id, $mdb_control, &$error_array)
	{
		$success = true;		
		$controller = $mdb_control->getController("member");
		$member = $controller->getByPrimaryKey("member_id", $member_id);
		
		if(isset($member))
		{
			$member->set_registration_complete(true);
			$success = $controller->updateAttribute($member, "registration_complete");
		}
		else 
		{ 
			$success = false; 
			$error_array[] = "The Member ID $member_id could not be found.";
		}
		
		return $success;
	}		
	
	
	public function setAdminType($administrator_id, $mdb_control, &$error_array)
	{
		if(isset($_POST['admin_type']))
		{
			$controller = $mdb_control->getController("administrator");
			$admin = $controller->getByPrimaryKey("administrator_id", $administrator_id);
			$admin->set_admin_type($_POST['admin_type']);
			$success = $controller->updateAttribute($admin, "admin_type");
		}
		else
		{
			$success = false;				
		}
		
		if(!$success) 
		{
			$error_array[] = "The Administrator type could not be set.";
		}
		
		return $success;
	}		
	
	
	public function getAdminTypes()
	{
		$types = array();
		$admin = new Administrator();
		$types = $admin->get_allowed_admin_types();		
		return $types;
	}
	
	
	public function validateProfessor($dataLine, $register, $mdb_control, &$error_array)
	{
		$success = true;
		$professor_id = (int)$dataLine[0]; 
		$firstname = trim($dataLine[1]); 
		$lastname = trim($dataLine[2]);  
		$email = trim($dataLine[3]);
		$school = trim($dataLine[4]); 
						
		$member = new Member();
		$controller = $mdb_control->getController("member");
		$member = $controller->getByPrimaryKey("member_id", $professor_id);
		
		$professor = new Professor();
		$controller = $mdb_control->getController("professor");
		$professor = $controller->getByPrimaryKey("professor_id", $professor_id);
		
		if(!isset($member))
		{ 
			$error_array[] = "The Member ID $member_id could not be found.";
			return false;
		}		
		
		$fname = $member->get_first_name();
		$lname = $member->get_last_name();
			
		if(strcmp($firstname,$fname) !=0)
		{
			$success = false;
			$error_array[] = "The Professor ID does not match the listed name.";
			$error_array[] = "first $firstname, member first $fname.";
		} 
		
		if(strcmp($lastname,$lname) !=0)
		{
			$success = false;
			$error_array[] = "The Professor ID does not match the listed name.";
			$error_array[] = "last $lastname, member last $lname.";
		} 
		
		if($email != $member->get_email())
		{
			$success = false;
			$error_array[] = "The Professor ID does not match the listed email.";
		} 
				
		if($school != $professor->get_school_name())
		{
			$success = false;
			$error_array[] = "The Professor ID does not match the listed school.";
		} 
					
		return $success;
	}
	
	
	
}

?>