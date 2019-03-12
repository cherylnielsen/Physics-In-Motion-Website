
<!-- Tables of links to other sections and section related actions -->
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
		<tr><td><button class='summaryButton' onclick='showStudentList();'>
			Student List</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showAssignmentList();'>
			Assignment List</button></td></tr>
		<tr><td><button class='summaryButton' onclick='showHomeworkList();'>
			Homework List</button></td></tr>
		
		<tr><th>Actions</th></tr>
		<tr><td><a href="professor-form-page.php?form_type=add_assignment" 
			class="actionButton">Add Assignment</a></td></tr>
		<tr><td><a href="professor-form-page.php?form_type=write_notice" 
			class="actionButton">Write Notice</a></td></tr>
	</table>
	
</nav>


