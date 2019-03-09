
<!-- Tables of links to other sections and section related actions -->
<nav id='secondary-navigation'>
<table class='summary actions'>

<?php
	$section_list = array();
	$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
	$sectionDisplay->displaySectionShortList($section_list, $mdb_control);

?>
	
		<tr><th>Show / Hide</th></tr>
		<tr><td><button class='summaryButton' onclick='showStudentList();'>
				 Student List</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showAssignmentList();'>
				Assignment List</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showHomeworkList();'>
				Homework List</button></td></tr>
		
		<tr><th>Actions</th></tr>
		<tr><td><button class='summaryButton' onclick='addAssignment();'>
				Add Assignment</button></td></tr>
		<tr><td><button class='summaryButton' onclick='gradeAssignment();'>
				Grade Assignment</button></td></tr>
	</table>
	
</nav>


