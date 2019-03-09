
<!-- Tables of links to notice related actions -->
<nav id='secondary-navigation'>
<table class='summary actions'>

<?php
	$section_list = array();
	$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
	$sectionDisplay->displaySectionShortList($section_list, $mdb_control);
?>
	
		<tr><th>Show / Hide</th></tr>
		<tr><td><button class='summaryButton' onclick='showSectionNotices();'>
				Section Notices</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showMemberInBoxNotices();'>
				Member In Box Notices</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showMemberSentNotices();'>
				Member Sent Notices</button></td></tr>
		
		<tr><th>Actions</th></tr>
		<tr><td><button class='summaryButton' onclick='writeNotice();'>
				Write Notice</button></td></tr>
	</table>
</nav>


