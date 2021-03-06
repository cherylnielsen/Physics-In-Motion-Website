<?php

require_once('../private/DatabaseControllerFactory.php');
require_once('../private/member_page_include_list.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$mdb_control = new DatabaseControllerFactory();
	$sectionAction->processTableForms($mdb_control);
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Physics in Motion: Professor Services</title>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Professor services include which Tutorial Labs each Student has been assigned or completed. The ability to download Tutorial Lab homework summaries, data, and graphs, submitted by Students. Commonly encountered problems, errors, and corrections for Tutorial Labs. Sending notices to Professors or Students.">
	
	<meta name="Keywords" content="professor services, physics in motion, tutorial lab, laboratory, homework, assignments">
		
	<?php 
		require_once('html-includes/template/common-db-and-css-links.php'); 
		require_once('../private/member_page_include_list.php');
	?>

	<link href="css/member-pages.css" rel="stylesheet" type="text/css" media="screen">
	<script src="javascript/member-actions.js" ></script>
	
</head>
<body>
<div class="wrapper">

<?php
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	if(!isset($_SESSION['professor_id']))
	{
		$url = "login-register-page.php?form_type=login";
		header("Location: $url");
		exit();
	}

	$professor_id = $_SESSION['professor_id'];
	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];

	include('html-includes/template/header.php'); 
	include('html-includes/navigation/main-navigation-and-quote.php');
?>

<section class="main-content">
<?php 
	echo "<h1 class='welcome'>Welcome Professor $first_name $last_name!</h1>";
	
	if(isset($_GET["section_id"]))
	{
		$section_id = $_GET["section_id"];
		include('html-includes/user-pages/professor-section-content.php');
	}
	else if(isset($_GET["notices"]))
	{
		include('html-includes/user-pages/professor-notice-content.php');
	}
	else
	{
		include('html-includes/user-pages/professor-home-content.php'); 
	}
	
?>
</section>
		
<?php include('html-includes/template/footer.html'); ?>

</div><!-- end div.wrapper -->	
</body>
</html>