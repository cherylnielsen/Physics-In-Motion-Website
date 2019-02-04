<?php

	require_once('../../../private/DatabaseControllerFactory.php'); 
	$mdb_control = new DatabaseControllerFactory();
	require_once('../../../private/action/login/login-utilities.php'); 
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	$login_utility = new LoginUtilities();	
	$login_utility->update_last_logout($_SESSION['user_id'], $mdb_control);
	
	// remove all session variables
	session_unset(); 
	session_destroy();
	
	$url = "../../index.php";
	header("Location: $url");
	exit();
	
?>
