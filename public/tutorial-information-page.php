<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Physics in Motion: Tutorial Labs</title>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Physics in Motion uses today�s powerful interactive online 3D gaming technologies to create a new type of science tutorial. Not as game, but as truly visual, immersive, and hands on learning experience. The Student can analyze the collected data with interactive graphs and math calculations done inside the tutorial lab. Along the way, the Automated Mentor will explain topics and give hints. Web pages for Students and professors provide multiple additional services.">
	
	<meta name="Keywords" content="physics in motion, engineering, tutorial, lab, laboratory, activities, experiments, 3d, 3-D, interactive, mentor, mentored, math, calculations">
		
	<link href="css/main.css" rel="stylesheet" type="text/css" media="screen">
	
	<link href="css/tutorial-lab.css" rel="stylesheet" type="text/css" media="screen">
	
	<link href="css/main-tablet.css" rel="stylesheet" type="text/css" 
		  media="screen and (min-width: 601px) and (max-width: 950px)">
	
	<link href="css/main-phone.css" rel="stylesheet" type="text/css" media="screen and (max-width: 600px)">
	
	<link href="css/print-main.css" rel="stylesheet" type="text/css" media="print">
	
	<?php 
		require_once('../private/MasterDatabaseController.php'); 
		$mdb_control = new MasterDatabaseController();
	?>
	
</head>
<body>
	
<div class="wrapper">

<header>	
	<?php include('html-includes/home/header.html'); ?>
</header>

<aside class="nav-quote" id="nav-quote">
	<?php include('html-includes/home/nav-and-quote.php'); ?>
</aside>

<section class="main-content">
	<?php include('html-includes/labs/lab-info.php'); ?>
</section>

<footer>
	<?php include('html-includes/home/footer.html'); ?>
</footer>

</div><!-- end div.wrapper -->
	
</body>
</html>