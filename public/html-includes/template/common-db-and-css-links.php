
<!-- cascading style sheets -->

<link href="css/main.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/navigation.css" rel="stylesheet" type="text/css" media="screen">

<link href="css/main-tablet.css" rel="stylesheet" type="text/css" 
	  media="screen and (min-width: 601px) and (max-width: 950px)">

<link href="css/main-phone.css" rel="stylesheet" type="text/css" media="screen and (max-width: 600px)">
<link href="css/print-main.css" rel="stylesheet" type="text/css" media="print">

<!-- outside Internet based style links for special font symbols etc. -->
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php 
	require_once('../private/DatabaseControllerFactory.php'); 
	$mdb_control = new DatabaseControllerFactory();		
?>