
<!-- Tables of links to other sections and section related actions -->
<aside class="second-navigation">
	<nav class='second-navigation'>
		<h2 class='navigation'>Student Current Sections</h2>		
					
<?php
	$section_list = array();
	$section_list = $sectionDisplay->getSectionList_ByStudent($student_id, $mdb_control);
	$sectionDisplay->displaySectionShortList($section_list, $mdb_control, "student");
?>
		<h2 class='navigation'>Show / Hide</h2>
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
			
		<h2 class='navigation'>Student Actions</h2>
		<a href="student-form-page.php?form_type=write_notice" 
			class="navigation">Write Notice</a>
					
	</nav>	
</aside>

