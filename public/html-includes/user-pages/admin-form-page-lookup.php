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
		case "edit_section":
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
