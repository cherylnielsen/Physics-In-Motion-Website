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
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Student services include which Tutorial Labs each Student has been assigned or completed. The ability to download Tutorial Lab summaries, data, graphs, and math work submitted by Students. Commonly encountered problems, errors, and corrections for Tutorial Labs. Sending notices to Students or Students.">
	
	<meta name="Keywords" content="student, student services, services, physics in motion, tutorial, tutorial lab, lab, laboratory">
		
	<?php 
		require_once('html-includes/template/common-db-and-css-links.php'); 	
		require_once('../private/member_page_include_list.php');
	?>
	<link href="css/member-pages.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/member-forms.css" rel="stylesheet" type="text/css" media="screen">
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
	
	if(!isset($_SESSION['student_id']))
	{
		$url = "login-register-page.php?form_type=login";
		header("Location: $url");
		exit();
	}

	$student_id = $_SESSION['student_id'];
	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];
	$form_type = $_GET["form_type"];

	include('html-includes/template/header.php'); 
	include('html-includes/navigation/main-navigation-and-quote.php'); 
?>

<section class="main-content">
<?php 
	echo "<h1 class=welcome>Welcome $first_name $last_name!</h1>";
	include($form_file_name);
?>
</section>
 	
<?php include('html-includes/template/footer.html');  ?>

</div><!-- end div.wrapper -->	
</body>
</html>