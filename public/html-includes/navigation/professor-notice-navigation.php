
<!-- Tables of links to notice related actions -->
<nav id='secondary-navigation'>
<table class='summary actions'>

	<tr><th>Section Memberships</th></tr>	
	<tr><td><a href="professor-page.php" class="actionButton">
				Professor Pages</a></td></tr>
				
<?php
	$section_list = array();
	$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
	$sectionDisplay->displaySectionShortList($section_list, $mdb_control, "professor");
?>
	
		<tr><th>Show / Hide</th></tr>
		<tr><td><button class='summaryButton' onclick='showSectionNotices();'>
				Section Notices</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showMemberInBoxNotices();'>
				Member In Box Notices</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showMemberSentNotices();'>
				Member Sent Notices</button></td></tr>
		
		<tr><th>Actions</th></tr>
		<tr><td><a href="professor-form-page.php?form_type=write_notice" 
					class="actionButton">Write Notice</a></td></tr>
		
	</table>
</nav>


