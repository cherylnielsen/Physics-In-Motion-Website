<?php

/**
 - List of assigned labs with Professor & due date
 - List of completed labs
 - Links to data download, math, graphs, screen shots, etc. from completed labs.
 - Links to download lab summaries with recommendations for problems encountered, time taken to complete the lab, etc.
 - Links to send a Notice of Lab Completion to a Professor that assigned a lab.
 - Links to rate completed labs.
**/

?>

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
	$assignmentDisplay->displaySectionAssignments($section_id, $mdb_control);
?>
</div>

<div id='homeworkListDiv' class='overflow'>
<?php
	// List of homework submitted for this section with links to view or download
	$assignmentDisplay->displaySubmittedHomework($section_id, $mdb_control);
?>
</div>


<a id="bottom" href="#top">return to top</a>




