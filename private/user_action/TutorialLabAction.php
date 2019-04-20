<?php

class tutorialLabAction
{
	public function __construct() {}

	
	public function processForms($mdb_control)
	{		
		if(isset($_POST['add_lab']))
		{
			$result = $this->addNewLab($mdb_control);
			return $result;			
		}

		if(isset($_POST['edit_lab']))
		{
			$result = $this->getTutorialLab($mdb_control);
			return $result;
		}
	}
		
	
	public function getLabFromDatabase($mdb_control)
	{
		if(isset($_POST['get_lab']))
		{
			$tutorial_lab_id = $_POST['get_lab'];
			$control = $mdb_control->getController("tutorial_lab");
			$tutorial_lab = $hmwk_control->getByPrimaryKey("tutorial_lab_id", $tutorial_lab_id);
			
			$tutorial_lab_name = $tutorial_lab->get_tutorial_lab_name();
			$tutorial_lab_web_link = $tutorial_lab->get_tutorial_lab_web_link();
			$tutorial_lab_introduction = $tutorial_lab->get_tutorial_lab_introduction();
			$prerequisites = $tutorial_lab->get_prerequisites();
			$key_topics = $tutorial_lab->get_key_topics();
			$key_equations = $tutorial_lab->get_key_equations();
			$description = $tutorial_lab->get_section_description();
			$instructions = $tutorial_lab->get_instructions();
			$date_first_available = $tutorial_lab->get_date_first_available();
			
			$dataStr = "lab_id=" . $tutorial_lab_id . 
						"&lab_name=" . $tutorial_lab_name . 
						"&web_link=" . $tutorial_lab_web_link . 
						"&lab_status=" . $lab_status . 
						"&introduction=" . $tutorial_lab_introduction . 
						"&filepath=" . $filepath . 
						"&prerequisites=" . $prerequisites .
						"&key_topics=" . $key_topics .
						"&key_equations=" . $key_equations . 
						"&description=" . $description .
						"&instructions=" . $instructions .
						"&date_first_available=" . $date_first_available;
			
			return $dataStr;
		}
	}
	
	
	public function getLabFromPOST()
	{
		$lab_id = $_POST['lab_id'];
		$lab_name = $_POST["lab_name"];
		$web_link = $_POST["web_link"];
		$lab_status = $_POST["lab_status"];
		$introduction = $_POST["introduction"];
		// filepath should maybe be generated instead
		$filepath = $_POST["filepath"];  
		$prerequisites = $_POST["prerequisites"];
		$key_topics = $_POST["key_topics"];
		$key_equations = $_POST["key_equations"];
		$description = $_POST["description"];
		$instructions = $_POST["instructions"];
		$date_first_available = $_POST["date_first_available"];
			
		$tutorial_lab = new Tutorial_Lab();			
		$tutorial_lab->initialize($lab_id, $lab_name, $web_link, 
				$lab_status, $introduction, $filepath);
								
		$tutorial_lab->initializePart2($prerequisites, $key_topics, $key_equations, 
				$description, $instructions, $date_first_available);
				
		return $dataStr;

	}
	
	
	public function addNewLab($mdb_control)
	{
		$success = true;
		$controller = $mdb_control->getController("tutorial_lab");
		
		if(isset($controller))
		{
			$tutorial_lab = new Tutorial_Lab();
			$tutorial_lab = getLabFromPOST();			
			$sucess = $controller->saveNew($tutorial_lab);
		}
		
		return $success;
	}
	
	
	public function editLab($mdb_control)
	{
		$success = true;		
		$controller = $mdb_control->getController("tutorial_lab");
		
		if(isset($controller))
		{
			$tutorial_lab = new Tutorial_Lab();
			$tutorial_lab = getLabFromPOST();
			$sucess = $controller->updateAll($tutorial_lab);
		}
		
		return $success;
	}
	
	
}


?>

