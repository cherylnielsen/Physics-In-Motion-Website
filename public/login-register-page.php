<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	
	<?php
		$form_type = $_GET["form_type"];
		
		if($form_type == "login")
		{
			echo '<title>Physics in Motion: Sign In</title>';
		}
		if($form_type == "register")
		{
			echo '<title>Physics in Motion: Registration</title>';
		}
	?>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Physics in Motion uses today’s powerful interactive online 3D gaming technologies to create a new type of science tutorial. Not as game, but as truly visual, immersive, and hands on learning experience. The Student can analyze the collected data with interactive graphs and math calculations done inside the tutorial lab. Along the way, the Automated Mentor will explain topics and give hints. Web pages for Students and Professors provide multiple additional services.">
	
	<meta name="Keywords" content="register, sign up, join, sign in, login, physics in motion, tutorial, tutorial lab, lab, laboratory">
		
	<?php 
		include('html-includes/template/common-db-and-css-links.php'); 
	?>
	
	<link href="css/register-login-form.css" rel="stylesheet" type="text/css" media="screen">
	<script src="javascript/register-login-form.js" ></script>
	
</head>
<body>
<div class="wrapper">

<?php
	include('html-includes/template/header.php'); 
	include('html-includes/template/main-navigation-and-quote.php'); 
?>

<section class="main-content">
<?php 
	include('html-includes/template/logo-statement.php'); 	
	
	$form_type = $_GET["form_type"];
		
		if($form_type == "login")
		{
			include('../private/login/login-action.php'); 
			include('html-includes/login/login-form.html'); 
		}
		if($form_type == "register")
		{
			include('../private/login/register-action.php'); 
			include('html-includes/login/register-form.html'); 
		}	
?>
</section>

<?php 
	include('html-includes/labs/new-labs-list.php'); 	
	include('html-includes/template/footer.html'); 
?>

</div><!-- end div.wrapper -->	
</body>
</html>