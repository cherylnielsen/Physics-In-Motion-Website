<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	
	<?php
		$form_type = $_GET["form_type"];    
		
		switch ($form_type)
		{
			case "login":
				echo '<title>Physics in Motion: Sign In</title>';
				break;
			case "register":
				echo '<title>Physics in Motion: Registration</title>';
				break;
			case "forgotlogin":
				echo '<title>Physics in Motion: Forgotten Sign In</title>';
				break;
			case "changelogin";
				echo '<title>Physics in Motion: Change Sign In</title>';
				break;
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
	include('html-includes/navigation/main-navigation-and-quote.php'); 
?>

<section class="main-content">

<?php 
	include('html-includes/template/logo-statement.html'); 	
	
	$form_type = $_GET["form_type"];
	$loggedIn = isset($_SESSION['member_id']);
	
	if ($loggedIn)
	{
		if($form_type == "changelogin")
		{
			include('../private/login/change-login-action.php'); 
			include('html-includes/login/change-login-form.html');
		}
		else
		{
			echo '<br><br>
			<div class="form-errors">
				<h1> You are already signed in. </h1>
				<a href="html-includes/login/logout.php"><h1>Sign Out?</h1></a>
			</div>';
		}
	}
	else
	{
		switch ($form_type)
		{
			case "login":
				include('../private/login/login-action.php'); 
				include('html-includes/login/login-form.html'); 
				break;
				
			case "register":
				include('../private/login/register-action.php'); 
				include('html-includes/login/register-form.html'); 
				break;
			
			case "forgotlogin":
				include('../private/login/forgot-login-action.php'); 
				include('html-includes/login/forgot-login-form.html'); 
				break;
				
			case "changelogin":
				include('../private/login/change-login-action.php');  
				include('html-includes/login/change-login-form.html');
				break;
		}
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