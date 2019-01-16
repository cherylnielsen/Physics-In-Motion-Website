<?php 
	
	echo	
	'<link href="css/main.css" rel="stylesheet" type="text/css" media="screen">
	
	<link href="css/main-tablet.css" rel="stylesheet" type="text/css" 
		  media="screen and (min-width: 601px) and (max-width: 950px)">
	
	<link href="css/main-phone.css" rel="stylesheet" type="text/css" media="screen and (max-width: 600px)">
	
	<link href="css/print-main.css" rel="stylesheet" type="text/css" media="print">';

	require_once('../private/DatabaseControllerFactory.php'); 
	$mdb_control = new DatabaseControllerFactory();
		
?>