<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Physics in Motion: Administrator Services</title>
	
	<meta name="Description" content="Administrator services for Professors and Students of Physics in Motion Tutorial Labs.">
	
	<meta name="Keywords" content="administrator, administrative services, physics in motion, tutorial lab">
		
	<?php 
		require_once('html-includes/template/common-db-and-css-links.php'); 	
		require_once('../private/member_page_include_list.php');
	?>
	
	<link href="css/member-pages.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/admin-pages.css" rel="stylesheet" type="text/css" media="screen">
	<script src="javascript/member-actions.js" ></script>

	
</head>
<body>
<div class="wrapper">

<?php
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	if(!isset($_SESSION['administrator_id']))
	{
		$url = "login-register-page.php?form_type=login";
		header("Location: $url");
		exit();
	}

	$administrator_id = $_SESSION['administrator_id'];
	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];

	include('html-includes/template/header.php'); 
	include('html-includes/navigation/main-navigation-and-quote.php');
?>

<section class="main-content">
<?php 
	echo "<h1 class='welcome'>Welcome $first_name $last_name!</h1>";
	
	if(isset($_GET["notices"]))
	{
		include('html-includes/user-pages/admin-notice-content.php');
	}
	else
	{
		include('html-includes/user-pages/admin-home-content.php'); 
	}
?>
</section>
		
<?php include('html-includes/template/footer.html'); ?>

</div><!-- end div.wrapper -->	
</body>
</html>