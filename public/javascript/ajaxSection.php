<?php
require_once('../../private/DatabaseControllerFactory.php'); 
require_once('../../private/user_action/SectionAction.php');
require_once('../../private/user_action/TutorialLabAction.php');

function ajaxSection()
{
	echo "<p>I am finally here.</p>";
	
	$dataString = "";
	$mdb_control = new DatabaseControllerFactory();	
	
	if(isset($_POST["get_section"]))
	{
		$section_id = $_POST["get_section"];
		$action = new SectionAction();
		$dataString = $action->getSection($mdb_control, $section_id);
	}
	else if(isset($_POST["get_tutorial_lab"]))
	{
		$lab_id = $_POST["get_tutorial_lab"];
		$action = new TutorialLabAction();
		$dataString = $action->getLabFromDatabase($mdb_control, $tutorial_lab_id);
	}
	
	return $dataString;
}

// The echo string of the result is then automatically returned
// as the AJAX response to the xhttp request.

echo ajaxSection();

?>

