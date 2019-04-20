
<!-- Administrator links and related actions -->

<?php	
	
	if(isset($_SESSION["administrator_id"]) && isset($_SESSION["member_type"]))
	{
		if(($_SESSION["member_type"] == "administrator"))
		{
?>

<nav class='second-navigation'>		
					
	<h2 class='navigation'>Notices</h2>
	
	<a href="admin-home-page.php?notices=notices" 
		class="navigation">View Notices</a>
	<a href="admin-form-page.php?form_type=write_notice" 
		class="navigation">Write a Notice</a>
		
	<h2 class='navigation'>Registration</h2>
	
		<div id='admin_nav_registration'>
			
			<a href="admin-form-page.php?form_type=professor_registration" 
				class="navigation">Confirm Professor</a>	
			<a href="admin-form-page.php?form_type=admin_registration" 
				class="navigation">Register Administrator</a>	
			<a href="login-register-page.php?form_type=changelogin" 
				class="navigation">Change Password</a>
				
		</div>
	
	<h2 class='navigation'>Sections</h2>

		<div id='admin_nav_sections'>
			<a href="admin-form-page.php?form_type=add_students" 
				class="navigation">Add Students to Section</a>
			<a href="admin-form-page.php?form_type=drop_students" 
				class="navigation">Drop Students from Section</a>
			<a href="admin-form-page.php?form_type=add_sections" 
				class="navigation">Add New Sections</a>
			<a href="admin-form-page.php?form_type=edit_section" 
				class="navigation">Edit Section</a>
			<a href="admin-form-page.php?form_type=drop_sections" 
				class="navigation">Drop Sections</a>
		</div>
	
	<h2 class='navigation'>Tutorial Labs</h2>
	
		<div id='admin_nav_labs'>			
			<a href="admin-form-page.php?form_type=add_tutorial_lab" 
				class="navigation">Add New Tutorial Lab</a>
			<a href="admin-form-page.php?form_type=edit_tutorial_lab" 
				class="navigation">Edit Tutorial Lab</a>
		</div>
	
	<h2 class='navigation'>Reviews</h2>
	
		<div id='admin_nav_labs'>
			<a href="admin-form-page.php?form_type=review_ratings" 
				class="navigation">Review Ratings</a>
			<a href="admin-form-page.php?form_type=review_content" 
				class="navigation">Review Content Complaints</a>
		</div>
		
</nav>

<!-- end if administrator -->
<?php 	}	} 	?>

			
