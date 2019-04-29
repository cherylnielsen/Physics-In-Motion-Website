<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	
	<?php
		$form_type = $_GET["form_type"];    
		
		switch ($form_type)
		{
			case "change_login";
				echo '<title>Physics in Motion: Change Sign In</title>';
				break;
			case "update_my_information";
				echo '<title>Physics in Motion: Update My Information</title>';
				break;
		}		
	?>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Physics in Motion uses today’s powerful interactive online 3D gaming technologies to create a new type of science tutorial. This is a visual, immersive, and hands on learning experience. The Student can analyze the collected data with interactive graphs and math calculations done inside the tutorial lab. Along the way, the Automated Mentor will explain topics and give hints. Web pages for Students and Professors provide additional services.">
	
	<meta name="Keywords" content="register, sign up, join, sign in, login, physics in motion, physics, engineering, tutorial, lab, laboratory, activities, experiments, 3d, 3-D, interactive, mentor, mentored, math, calculations, graphs">
		
	<?php 
		require_once('html-includes/template/common-db-and-css-links.php'); 
		require_once('../private/member_page_include_list.php');
	?>
	
	<link href="css/register-login-form.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/member-forms.css" rel="stylesheet" type="text/css" media="screen">
	<script src="javascript/register-login-form.js" ></script>
	
</head>
<body>
<div class="wrapper">

<?php
	include('html-includes/template/header.php'); 
	include('html-includes/navigation/main-navigation-and-quote.php'); 
?>

<section class="main-content-forms">

<?php 
	include('html-includes/template/logo-statement.html'); 	
	
	$form_type = $_GET["form_type"];
	$loggedIn = isset($_SESSION['member_id']);
	
	if ($loggedIn)
	{
		switch ($form_type)
		{
			case "change_login":
				include('../private/login/change-login-action.php'); 
				include('html-includes/login/change-login-form.html'); 
				break;
				
			case "update_my_information":
				include('../private/login/update-action.php'); 
				include('html-includes/login/update-my-information.html'); 
				break;
		}
	}
	else
	{
		$url = "index.php";
		header("Location: $url");
		exit();
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