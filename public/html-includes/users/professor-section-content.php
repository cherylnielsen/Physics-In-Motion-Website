


<div>
<?php
	// Welcome headings
	echo "<h1 class=welcome>Welcome $first_name $last_name!</h1>";
	$sectionDisplay->displaySectionWelcome($section_id, $mdb_control);	
?>	
</div>

<div id='studentListDiv' class='overflow'>
<?php
	// List of students that are members of this section
	$sectionDisplay->displaySectionStudentList($section_id, $mdb_control);
?>
</div>

<div id='assignmentListDiv' class='overflow'>
<?php
	// List of assignments for this section
	$assignmentDisplay->displaySectionAssignments($section_id, $mdb_control, true);
?>	
</div>

<div id='homeworkListDiv' class='overflow'>
<?php
	// List of homework submitted for this section with links to view or download
	$assignmentDisplay->displaySubmittedHomework($section_id, $mdb_control);
?>
</div>


<a id="bottom" href="#top">return to top</a>




