<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sectionAction->processTableForms($mdb_control);
	}		
	
?>


<div>
<?php
	// Welcome headings
	$sectionDisplay->displaySectionWelcome($section_id, $mdb_control);	
?>	
</div>

<div id='studentListDiv' class='overflow'>
<?php
	// List of students that are members of this section
	// need to add grades and stats for each student (second or same table?)
	$studentTables->displayStudentList($section_id, $mdb_control);
?>
</div>


<div id='assignmentListDiv' class='overflow'>
<?php
	// List of assignments for this section
	$assignmentDisplay->displaySectionAssignments($section_id, $mdb_control, "professor");
?>	
</div>

<div id='homeworkListDiv' class='overflow'>
<?php
	// List of homework submitted for this section with links to view or download
	$assignmentDisplay->displaySubmittedHomework($section_id, $mdb_control);
?>
</div>


<a id="bottom" href="#top">return to top</a>




