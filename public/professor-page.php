<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Physics in Motion: Professor Services</title>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Professor services include which Tutorial Labs each Student has been assigned or completed. The ability to download Tutorial Lab summaries, data, graphs, and math work submitted by Students. Commonly encountered problems, errors, and corrections for Tutorial Labs. Sending notices to Professors or Students.">
	
	<meta name="Keywords" content="professor, professor services, services, physics in motion, tutorial, tutorial lab, lab, laboratory">
		
	<?php include('html-includes/template/common-db-and-css-links.php'); ?>	
	<link href="css/professor-student-page.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/professor-student-form.css" rel="stylesheet" type="text/css" media="screen">
	
</head>
<body>
<div class="wrapper">

<?php include('html-includes/template/header.php'); ?>
<?php include('html-includes/template/nav-and-quote.php'); ?>

<section class="main-content">
	<?php include('../private/action/user-pages/MemberDataUtilities.php'); ?>
	<?php include('../private/action/user-pages/MemberDisplayUtilities.php'); ?>
	<?php include('../private/action/user-pages/MemberActions.php'); ?>
	<?php include('../private/action/user-pages/DisplaySectionData.php'); ?>
	<?php include('../private/action/user-pages/DisplayNotices.php'); ?>
	<?php include('html-includes/users/professor-page-main-content.php'); ?>
</section>
		
<?php include('html-includes/template/footer.html'); ?>

</div><!-- end div.wrapper -->	
</body>
</html>