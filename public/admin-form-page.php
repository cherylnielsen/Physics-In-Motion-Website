<?php
		$form_type = $_GET["form_type"];
		$form_name = "";
		$form_file_name = "";
		
		switch ($form_type)
		{
			case "write_notice":
				$form_file_name = "html-includes/user-forms/write-notice-form.html";
				$form_name = "Write Notice";
			break;
			
			case "review_ratings":
			case "review_content":
				$form_file_name = "html-includes/admin-review-forms/" . 
									$form_type . "_form.html";
			break;
			
			case "professor_registration":
			case "admin_registration":
			case "edit_professor":
			case "edit_administrator":
			case "changelogin":
				$form_file_name = "html-includes/admin-registration-forms/" . 
								$form_type . "_form.html";
			break;
			
			case "add_students":
			case "drop_students":
			case "edit_student":
				$form_file_name = "html-includes/admin-student-forms/" . 
									$form_type . "_form.html";
			break;
			
			case "add_sections":
			case "drop_sections":
			case "edit_sections":
				$form_file_name = "html-includes/admin-section-forms/" . 
									$form_type . "_form.html";
			break;
			
			case "add_tutorial_lab":
			case "edit_tutorial_lab":
				$form_file_name = "html-includes/admin-tutorial-lab-forms/" . 
									$form_type . "_form.html";
			break;
			
		}
		
	?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	
	<?php
		echo "<title>Physics in Motion: Administrator $form_name</title>";
	?>
	
	<meta name="Description" content="Interactive 3D Tutorial Lab experiences for Students of Physics and Engineering. Administrator services to be decided. Sending notices to administrators or Students.">
	
	<meta name="Keywords" content="administrator, administrator services, services, physics in motion, tutorial, tutorial lab, lab, laboratory">
		
	<?php 
		require_once('html-includes/template/common-db-and-css-links.php'); 	
		require_once('../private/member_page_include_list.php');
		require_once('../private/admin_action/AdministrativeActions.php');
	?>
	
	<link href="css/member-pages.css" rel="stylesheet" type="text/css" media="screen">
	<link href="css/member-forms.css" rel="stylesheet" type="text/css" media="screen">
	<script src="javascript/member-form.js" ></script>
	<script src="javascript/ajax-admin-forms.js" ></script>
	
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
	$form_type = $_GET["form_type"];

	include('html-includes/template/header.php'); 
	include('html-includes/navigation/main-navigation-and-quote.php'); 
?>

<section class="main-content-forms">
<?php 	
	echo "<h1 class='welcome'>Welcome $first_name $last_name!</h1>";
	include($form_file_name);
?>
</section>
 	
<?php include('html-includes/template/footer.html'); ?>

</div><!-- end div.wrapper -->	
</body>
</html>