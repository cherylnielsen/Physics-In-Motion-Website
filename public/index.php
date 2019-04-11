 <!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	
	<title>Physics in Motion: Home Page</title>
		
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Physics in Motion uses today’s powerful interactive online 3D gaming technologies to create a new type of science tutorial. Not as game, but as truly visual, immersive, and hands on learning experience. The Student can analyze data collected from labs with interactive graphs and math calculations. Along the way, the Automated Mentor will explain topics and give hints. Additional services provided for Students and Professors.">
	
	<meta name="Keywords" content="physics in motion, physics, engineering, tutorial, lab, laboratory, activities, experiments, 3d, 3-D, interactive, mentor, mentored, math, calculations, graphs">
	
	<?php include('html-includes/template/common-db-and-css-links.php'); ?>
	
	<link href="css/home-page-project-summary.css" rel="stylesheet" type="text/css" media="screen">
	
</head>
<body>
<div class="wrapper">
<?php include('html-includes/template/header.php'); ?>

<section class="main-body" >
	<?php include('html-includes/navigation/main-navigation-and-quote.php'); ?>
		<section class="main-content">	
			<?php include('html-includes/template/home-page-project-summary.html'); ?>
		</section>
	<?php include('html-includes/labs/new-labs-list.php'); ?>	
</section>	

<?php include('html-includes/template/footer.html'); ?>
</div>
</body>
</html>