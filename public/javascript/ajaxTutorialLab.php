<?php
require_once('../../private/DatabaseControllerFactory.php'); 

// The echo string of the result at the end of the file
// is then automatically returned
// as the AJAX response to the xhttp request.
echo ajaxTutorialLab();


function ajaxTutorialLab()
{
	$dataString = "";
	$mdb_control = new DatabaseControllerFactory();	
	
	if(isset($_POST["get_tutorial_lab"]))
	{
		$lab_id = $_POST["get_tutorial_lab"];
		$dataString = getLabFromDatabase($mdb_control, $lab_id);
	}
	
	return $dataString;
}


function getLabFromDatabase($mdb_control, $tutorial_lab_id)
{
	$tutorial_lab = new Tutorial_Lab();
	$control = $mdb_control->getController("tutorial_lab");
	$tutorial_lab = $control->getByPrimaryKey("tutorial_lab_id", $tutorial_lab_id);
	
	$tutorial_lab_name = $tutorial_lab->get_tutorial_lab_name();
	$web_link = $tutorial_lab->get_tutorial_lab_web_link();
	$introduction = $tutorial_lab->get_tutorial_lab_introduction();
	$lab_status = $tutorial_lab->get_lab_status();
	$prerequisites = $tutorial_lab->get_prerequisites();
	$key_topics = $tutorial_lab->get_key_topics();
	
	$key_equations = $tutorial_lab->get_key_equations();
	
	if(empty($key_equations)) 
	{ $key_equations = "no current file exists"; }
	
	$description = $tutorial_lab->get_description();
	
	if(empty($description)) 
	{ $description = "no current file exists"; }
	
	$instructions = $tutorial_lab->get_instructions();
	
	if(empty($instructions)) 
	{ $instructions = "no current file exists"; }
	
	$dataStr = "tutorial_lab_name=" . $tutorial_lab_name . 
				"&web_link=" . $web_link . 
				"&lab_status=" . $lab_status . 
				"&introduction=" . $introduction . 
				"&prerequisites=" . $prerequisites .
				"&key_topics=" . $key_topics .
				"&key_equations=" . $key_equations . 
				"&description=" . $description .
				"&instructions=" . $instructions;

	return $dataStr;
}





?>

