
<!-- Administrator links and related actions -->

<?php	

	$page = $_SERVER['REQUEST_URI'];
	$pageOK = strpos($page, "admin");
	
	if(isset($_SESSION["administrator_id"]) && isset($_SESSION["member_type"]))
	{
		if(($_SESSION["member_type"] == "administrator") && ($pageOK !== false))
		{
?>

<nav class='second-navigation'>		
	
	<h2 class='navigation'>Administrator Pages</h2>
	
	<a id="admin_home_pg_link" href="admin-home-page.php" 
		class="navigation">Administrator</a>	
	<a id="admin_section_pg_link" href="admin-home-page.php?section=section" 
		class="navigation">Sections</a>
	<a id="admin_section_pg_link" href="admin-home-page.php?notices=notices" 
		class="navigation">Notices</a>
					
	<h2 class='navigation'>Actions</h2>
	
	<a href="login-register-page.php?form_type=changelogin" 
		class="navigation">Change Password</a>
	<a href="admin-form-page.php?form_type=write_notice" 
		class="navigation">Write Notice</a>
	<a href="admin-form-page.php?form_type=section_members" 
		class="navigation">Add or Drop Students from Section</a>
	<a href="admin-form-page.php?form_type=section_members" 
		class="navigation">Add or Drop Professor from Section</a>
	<a href="admin-form-page.php?form_type=section_members" 
		class="navigation">Add or Edit Section</a>
	<a href="admin-form-page.php?form_type=section_members" 
		class="navigation">Add or Edit Tutorial Lab Information</a>
		
</nav>

<!-- end if administrator -->
<?php 	}	} 	?>

			
