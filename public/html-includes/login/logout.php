<?php

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
	
}

	// remove all session variables
	session_unset(); 
	session_destroy();
	
	$url = "../../index.php";
	header("Location: $url");
	exit();
	
?>
