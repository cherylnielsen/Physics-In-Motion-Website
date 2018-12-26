<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Physics in Motion: Sign In</title>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Physics in Motion uses today�s powerful interactive online 3D gaming technologies to create a new type of science tutorial. Not as game, but as truly visual, immersive, and hands on learning experience. The Student can analyze the collected data with interactive graphs and math calculations done inside the tutorial lab. Along the way, the Automated Mentor will explain topics and give hints. Web pages for Students and Professors provide multiple additional services.">
	
	<meta name="Keywords" content="sign in, login, physics in motion, tutorial, tutorial lab, lab, laboratory">
		
	<?php 
		include('html-includes/template/common-db-and-css-links.php'); 
	?>
	
	<link href="css/login-forms.css" rel="stylesheet" type="text/css" media="screen">
	
</head>
<body>
<div class="wrapper">

<?php include('html-includes/template/header.php'); ?>
<?php include('html-includes/template/nav-and-quote.php'); ?>


<section class="main-content">
	<?php include('html-includes/template/logo-statement.php'); ?>
	<?php include('../private/action/login-action.php'); ?>
	<?php include('html-includes/login/login-form.html'); ?>
</section>

<?php include('html-includes/labs/new-labs-list.php'); ?>			
<?php include('html-includes/template/footer.html'); ?>

</div><!-- end div.wrapper -->	
</body>
</html>