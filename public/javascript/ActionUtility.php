<?php

require_once('../../private/DatabaseControllerFactory.php'); 
require_once('../../private/user_action/SectionAction.php');

// helper code for the redirection of AJAX requests
function ajaxSubmitHomework()
{
	if(isset($_POST['submit_homework']))
	{
		$mdb_control = new DatabaseControllerFactory();	
		$action = new SectionAction();
		$homework_id = $_POST['submit_homework'];
		$success = $action->submitHomework($homework_id, $mdb_control);
	}
	
	return $success;
}

echo ajaxSubmitHomework();

?>