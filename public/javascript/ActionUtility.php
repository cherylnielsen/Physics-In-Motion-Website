<?php

require_once('../../private/DatabaseControllerFactory.php'); 
require_once('../../private/user_action/SectionAction.php');

//echo " you are now inside of ActionUtility.php ";
//echo " data sent was homework id is " . $_GET['submit_homework'];
//echo " data sent was homework id is " . $_POST['submit_homework'];

function ajaxSubmitHomework()
{
	//echo " inside ajaxSubmitHomework  ";
	$mdb_control = new DatabaseControllerFactory();	
	$formAction = new SectionAction();
	$result = $formAction->processTableForms($mdb_control);
	
	return $result;
}

// The echo string of the result is then automatically returned
// as the AJAX response to the xhttp request.

echo ajaxSubmitHomework();



?>

