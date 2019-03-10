<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Physics in Motion: Student Services</title>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Student services include which Tutorial Labs each Student has been assigned or completed. The ability to download Tutorial Lab summaries, data, graphs, and math work submitted by Students. Commonly encountered problems, errors, and corrections for Tutorial Labs. Sending notices to Students or Students.">
	
	<meta name="Keywords" content="student, student services, services, physics in motion, tutorial, tutorial lab, lab, laboratory">
		
	<?php 
		require_once('html-includes/template/common-db-and-css-links.php'); 	
		require_once('../private/member_page_include_list.php');
	?>
	<link href="css/professor-student-page.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/professor-student-form.css" rel="stylesheet" type="text/css" media="screen">
	<script src="javascript/member-actions.js" ></script>
	
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
		$url = "login-page.php";
		header("Location: $url");
		exit();
	}

	$student_id = $_SESSION['student_id'];
	$first_name = $_SESSION["first_name"];
	$last_name = $_SESSION["last_name"];
	$section_id = $_GET["section_id"];

	include('html-includes/template/header.php'); 
	include('html-includes/template/main-navigation-and-quote.php'); 
	include('html-includes/users/student-section-navigation.php');
?>

<section class="main-content">
<?php 	
	include('html-includes/users/student-section-content.php'); 
?>
</section>
 	
<?php include('html-includes/template/footer.html');  ?>

</div><!-- end div.wrapper -->	
</body>
</html>