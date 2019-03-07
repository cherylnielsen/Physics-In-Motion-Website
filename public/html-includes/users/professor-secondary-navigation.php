
<!-- Tables of links to other sections and section related actions -->
<nav class='secondary-navigation'>

<?php
	$section_list = array();
	$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
	$sectionDisplay->displaySectionShortList($section_list, $mdb_control);
?>

	<table class='summary actions'>
	
		<tr><th>Show / Hide</th></tr>
		<tr><td><button class='summaryButton' onclick='showStudentList();'>
				 Student List</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showAssignmentList();'>
				Assignment List</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showHomeworkList();'>
				Homework List</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showSectionNotices();'>
				Section Notices</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showMemberNotices();'>
				Member Notices</button></td></tr>
		
		<tr><th>Actions</th></tr>
		<tr><td><button class='summaryButton' onclick='addAssignment();'>
				Add Assignment</button></td></tr>
		<tr><td><button class='summaryButton' onclick='writeNotice();'>
				Write Notice</button></td></tr>
	</table>
	
</nav>


