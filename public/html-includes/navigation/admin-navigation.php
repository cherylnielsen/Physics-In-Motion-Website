
<!-- Administrator links and related actions -->

<?php	
	
	if(isset($_SESSION["administrator_id"]) && isset($_SESSION["member_type"]))
	{
		if(($_SESSION["member_type"] == "administrator"))
		{
?>

<nav class='second-navigation'>		
					
	<h2 class='navigation nav_show_hide' onclick="showHideNav('nav_notices')">Notices</h2>
	
		<div id='nav_notices' class='nav_show_hide'>
			<a href="admin-home-page.php?notices=notices" 
				class="navigation">View Notices</a>
			<a href="admin-form-page.php?form_type=write_notice" 
				class="navigation">Write a Notice</a>
		</div>
	
	<h2 class='navigation nav_show_hide' onclick="showHideNav('nav_registration')">Registration</h2>
	
		<div id='nav_registration' class='nav_show_hide'>
			
			<a href="admin-form-page.php?form_type=professor_registration" 
				class="navigation">Confirm Professor</a>	
			<a href="admin-form-page.php?form_type=admin_registration" 
				class="navigation">Register Administrator</a>	
			<a href="login-register-page.php?form_type=changelogin" 
				class="navigation">Change Password</a>
				
		</div>
	
	<h2 class='navigation nav_show_hide' onclick="showHideNav('nav_sections')">Sections</h2>

		<div id='nav_sections' class='nav_show_hide'>
			<a href="admin-form-page.php?form_type=add_sections" 
				class="navigation">Add New Sections</a>
			<!--<a href="admin-form-page.php?form_type=edit_section" -->
			<a href="" class="navigation not-enabled">Edit Section</a>
			<a href="admin-form-page.php?form_type=drop_sections" 
				class="navigation">Drop Sections</a>
		</div>
	
	<h2 class='navigation nav_show_hide' onclick="showHideNav('nav_students')">Students</h2>

		<div id='nav_students' class='nav_show_hide'>
			<a href="admin-form-page.php?form_type=add_students" 
				class="navigation">Add Students to Section</a>
			<a href="admin-form-page.php?form_type=drop_students" 
				class="navigation">Drop Students from Section</a>
		</div>
		
	<h2 class='navigation nav_show_hide' onclick="showHideNav('nav_labs')">Tutorial Labs</h2>
	
		<div id='nav_labs' class='nav_show_hide'>			
			<a href="admin-form-page.php?form_type=add_tutorial_lab" 
				class="navigation">Add New Tutorial Lab</a>
			<!--<a href="admin-form-page.php?form_type=edit_tutorial_lab" -->
			<a href="" class="navigation not-enabled">Edit Tutorial Lab</a>
		</div>
	
	<h2 class='navigation nav_show_hide' onclick="showHideNav('nav_reviews')">Reviews</h2>
	
		<div id='nav_reviews' class='nav_show_hide'>
			<!--<a href="admin-form-page.php?form_type=review_ratings"-->
			<a href="" class="navigation not-enabled">Review Ratings</a>
			<!--<a href="admin-form-page.php?form_type=review_content"-->
			<a href="" class="navigation not-enabled">Review Content Complaints</a>
		</div>
		
</nav>

<!-- end if administrator -->
<?php 	}	} 	?>

			
