
<!-- Tables of links to other sections and section related actions -->
<aside class="second-navigation">
	<nav class='navigation'>		
		<h2 class='navigation'>Professor Current Sections</h2>	
				
<?php
	$section_list = array();
	$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
	$sectionDisplay->displaySectionShortList($section_list, $mdb_control, "professor");
?>
	
		<h2 class='navigation'>Show / Hide</h2>
		<button class='navigation' onclick='showStudentList();'>
			Student List</button>
		<button class='navigation' onclick='showAssignmentList();'>
			Assignment List</button>
		<button class='navigation' onclick='showHomeworkList();'>
			Homework List</button>
		<button class='navigation' onclick='showSectionNotices();'>
			Section Notices</button>
		<button class='navigation' onclick='showMemberInBoxNotices();'>
			Member In Box</button>
		<button class='navigation' onclick='showMemberSentNotices();'>
			Member Sent</button>
		
		<h2 class='navigation'>Professor Actions</h2>
		<a href="professor-form-page.php?form_type=add_assignment" 
			class="navigation">Add Assignment</a>
		<a href="professor-form-page.php?form_type=write_notice" 
			class="navigation">Write Notice</a>
	</nav>
</aside>

