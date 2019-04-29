<!-- Administrator links and related actions -->
<?php	
	if(isset($_SESSION["administrator_id"]) && isset($_SESSION["member_type"]))
	{
		if(($_SESSION["member_type"] == "administrator"))
		{
?>

<nav class='second-navigation'>		
					
	<h2 class='navigation'>Notices</h2>
	
		<div id='nav_notices' class='navigation'>
			<a href="admin-home-page.php?notices=notices" 
				class="navigation">View Notices</a>
			<a href="admin-form-page.php?form_type=write_notice" 
				class="navigation">Write a Notice</a>
		</div>
		
		<?php
		if(isset($_GET["notices"]))
		{
		?>		
			<button class='navigation' 
				onclick='showTable("memberInBoxNoticeDiv");'>Show/Hide In Box</button>			
			<button class='navigation' 
				onclick='showTable("memberSentNoticeDiv");'>Show/Hide Sent</button>
				
		<?php } ?>
	
	<h2 class='navigation'>Sections & Tutorial Labs</h2>

		<div id='nav_sections' class='navigation'>
			<a href="admin-form-page.php?form_type=add_sections" 
				class="navigation">Add New Sections</a>
			<a href="admin-form-page.php?form_type=drop_sections" 
				class="navigation">Drop Sections</a>
			<a href="admin-form-page.php?form_type=edit_section" 
				class="navigation">Edit Section</a>		
			<a href="admin-form-page.php?form_type=add_tutorial_lab" 
				class="navigation">Add New Tutorial Lab</a>
			<a href="admin-form-page.php?form_type=edit_tutorial_lab" 
				class="navigation">Edit Tutorial Lab</a>
		</div>
	
	<h2 class='navigation'>Registration</h2>

		<div id='nav_students' class='navigation'>
			<a href="admin-form-page.php?form_type=add_students" 
				class="navigation">Add Students to Section</a>
			<a href="admin-form-page.php?form_type=drop_students" 
				class="navigation">Drop Students from Section</a>
			<a href="admin-form-page.php?form_type=confirm_registration" 
				class="navigation">Confirm Registration</a>	
			<a href="admin-form-page.php?form_type=admin_registration" 
				class="navigation">Register Administrator</a>
			<a href="update-register-page.php?form_type=change_login" 
				class="navigation">Change My Password</a>
			<!--<a href="update-register-page.php?form_type=update_my_information" -->
			<a class="navigation not-enabled">Update My Information</a>
		</div>
	
	<h2 class='navigation'>Reviews</h2>
	
		<div id='nav_reviews' class='navigation'>
			<!--<a href="admin-form-page.php?form_type=review_ratings"-->
			<a class="navigation not-enabled">Review Ratings</a>
			<!--<a href="admin-form-page.php?form_type=review_content"-->
			<a class="navigation not-enabled">Review Content Complaints</a>
		</div>
		
</nav>

<!-- end if administrator -->
<?php 	}	} 	?>

			
