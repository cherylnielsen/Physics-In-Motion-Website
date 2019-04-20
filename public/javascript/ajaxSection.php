<?php

require_once('../../private/DatabaseControllerFactory.php'); 
require_once('../../private/user_action/SectionAction.php');
require_once('../../private/user_action/FileAction.php');

function ajaxSection()
{
	$mdb_control = new DatabaseControllerFactory();	
	$formAction = new SectionAction();	
	$result = $formAction->getSection($mdb_control);	
	
	return $result;
}

// The echo string of the result is then automatically returned
// as the AJAX response to the xhttp request.

echo ajaxSection();

?>

