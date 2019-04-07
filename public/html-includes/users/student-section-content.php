<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['submit_homework']))
		{
			$hmwk_id = $_POST['submit_homework'];
			$sectionAction->submitHomework($hmwk_id, $mdb_control);
		}		
	}
		
?>

<div>
<?php
	// Welcome headings
	$sectionDisplay->displaySectionWelcome($section_id, $mdb_control);	
?>	
</div>

<div id='assignmentListDiv' class='overflow'>
<?php
	// List of assignments for this section
	$assignmentDisplay->displaySectionAssignments($section_id, $mdb_control, "student");
?>
</div>

<div id='homeworkListDiv' class='overflow'>
<?php
	// List of homework submitted for this section with links to view or download
	$assignmentDisplay->displayStudentHomework($section_id, $student_id, $mdb_control);
?>
</div>

<a id="bottom" href="#top">return to top</a>




