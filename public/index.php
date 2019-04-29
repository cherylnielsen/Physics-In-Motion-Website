 <!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	
	<title>Physics in Motion: Home Page</title>
		
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Physics in Motion uses today’s powerful interactive online 3D gaming technologies to create a new type of science tutorial. This is a visual, immersive, and hands on learning experience. The Student can analyze the collected data with interactive graphs and math calculations done inside the tutorial lab. Along the way, the Automated Mentor will explain topics and give hints. Web pages for Students and Professors provide additional services.">
	
	<meta name="Keywords" content="physics in motion, physics, engineering, tutorial, lab, laboratory, activities, experiments, 3d, 3-D, interactive, mentor, mentored, math, calculations, graphs">
	
	<?php 
		require_once('html-includes/template/common-db-and-css-links.php'); 
		require_once('../private/member_page_include_list.php');
	?>
	
	<link href="css/home-page-project-summary.css" rel="stylesheet" type="text/css" media="screen">
	
</head>
<body>
<div class="wrapper">
<?php include('html-includes/template/header.php'); ?>

<?php include('html-includes/navigation/main-navigation-and-quote.php'); ?>
	<section class="main-content">	
		<?php include('html-includes/template/logo-statement.html'); ?>
		<?php include('html-includes/template/home-page-project-summary.html'); ?>
	</section>
<?php include('html-includes/labs/new-labs-list.php'); ?>	

<?php include('html-includes/template/footer.html'); ?>
</div>
</body>
</html>