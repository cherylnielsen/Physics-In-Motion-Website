
<!-- Administrator links and related actions -->

<?php	
	
	$page = $_SERVER['REQUEST_URI'];
	$pageOK = strpos($page, "admin");

	if(isset($_SESSION["administrator_id"]) && isset($_SESSION["member_type"]))
	{
		if(($_SESSION["member_type"] === "administrator") && ($pageOK !== false))
		{
?>

<nav class='second-navigation'>		
	
	<h2 class='navigation'>Administrator Pages</h2>
	<a id="admin_main_pg_link" href="admin-main-page.php" 
		class="navigation">Main</a>	
	<a id="admin_section_pg_link" href="admin-section-page.php" 
		class="navigation">Sections</a>
	<a id="admin_section_pg_link" href="admin-notice-page.php" 
		class="navigation">Notices</a>
					
	<h2 class='navigation'>Show / Hide</h2>
	<button class='navigation' onclick='showMemberInBoxNotices();'>
		Member In Box</button>
	<button class='navigation' onclick='showMemberSentNotices();'>
		Member Sent</button>	
	<button class='navigation' onclick='showFlaggedNotices();'>
		Flagged Notices</button>
	<button class='navigation' onclick='showFlaggedReviews();'>
		Flagged Reviews</button>	
			
	<h2 class='navigation'>Actions</h2>
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

<!-- end if blocks -->
<?php 	}	} 	?>

			
