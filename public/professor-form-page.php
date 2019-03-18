<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	
	<?php
		$form_type = $_GET["form_type"];		
		$strArray = array();
		$strArray = explode("_", $form_type);
		$form_name = implode(" ", $strArray);
		$form_name = ucwords($form_name);		
		echo "<title>Physics in Motion: $form_name</title>";
		$form_file_name = "html-includes/user-forms/" . implode("-", $strArray) . "-form.html";		
	?>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Professor services include which Tutorial Labs each Student has been assigned or completed. The ability to download Tutorial Lab summaries, data, graphs, and math work submitted by Students. Commonly encountered problems, errors, and corrections for Tutorial Labs. Sending notices to Professors or Students.">
	
	<meta name="Keywords" content="professor, professor services, services, physics in motion, tutorial, tutorial lab, lab, laboratory">
		
	<?php 
		require_once('html-includes/template/common-db-and-css-links.php'); 	
		require_once('../private/member_page_include_list.php');
	?>
	<link href="css/professor-student-page.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/professor-student-form.css" rel="stylesheet" type="text/css" media="screen">
	<script src="javascript/member-actions.js" ></script>
	<script src="javascript/member-forms.js" ></script>
	
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
	$form_type = $_GET["form_type"];

	include('html-includes/template/header.php'); 
	include('html-includes/template/main-navigation-and-quote.php');
	
	if(strcmp($form_type, "write_notice") !== 0)
	{
		include('html-includes/navigation/professor-section-navigation.php');
	}
	else
	{
		include('html-includes/navigation/professor-notice-navigation.php');
	}
	
?>

<section class="main-content">
<?php 
	echo "<h1 class=welcome>Welcome $first_name $last_name!</h1>";
	include($form_file_name);
?>
</section>
		
<?php include('html-includes/template/footer.html'); ?>

</div><!-- end div.wrapper -->	
</body>
</html>