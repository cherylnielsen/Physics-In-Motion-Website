<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Physics in Motion</title>
	
	<meta name="Description" content="An interactive 3D Tutorial Lab experience for Students of Physics and Engineering. Physics in Motion uses today’s powerful interactive online 3D gaming technologies to create a new type of science tutorial. Not as game, but as truly visual, immersive, and hands on learning experience. The Student will then analyze the collected data with interactive graphs and math calculations done inside the tutorial lab. Along the way, the Automated Mentor will explain topics to the Students, give hints, and provide corrections as needed in the tutorial labs. Web pages for Students and professors provide multiple services, including lists of assigned and completed tutorial labs, links to download lab summaries, and lists of frequent problems encountered by Students.">
	
	<meta name="Keywords" content="physics in motion, physics, engineering, tutorial, lab, laboratory, activities, experiments, 3d, 3-D, interactive, mentor, mentored, math, calculations, graphs, sfsu">
		
	<link href="css/main.css" rel="stylesheet" type="text/css" media="screen">
	
	<link href="css/main-tablet.css" rel="stylesheet" type="text/css" 
		  media="screen and (min-width: 601px) and (max-width: 950px)">
	
	<link href="css/main-phone.css" rel="stylesheet" type="text/css" media="screen and (max-width: 600px)">
	
	<link href="css/print-main.css" rel="stylesheet" type="text/css" media="print">
	
</head>
<body>
	
<div class="wrapper">

<header>	
	<?php include('html-includes/header.html'); ?>
</header>

<aside class="nav-quote" id="nav-quote">
	<?php include('html-includes/nav-and-quote.php'); ?>
</aside>

<h1 class="summary">An interactive 3D Tutorial Lab experience for Students of Physics and Engineering.</h1>


<section class="main-content">
	<?php include('html-includes/project-summary.html'); ?>
</section>

<section class="new-labs">
	<a id="new-labs" href="index.php">return to top</a>	
	<h1>Tutorial Labs: New or Currently in Development</h1>	
	
	<?php include('html-includes/new-labs-list.php'); ?>	
	
	<a id="bottom" href="index.php">return to top</a>
</section>
		
<footer>
	<?php include('html-includes/footer.html'); ?>
</footer>

</div><!-- end div.wrapper -->
	
</body>
</html>