<?php

	/**
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['submit_homework']))
		{
			$hmwk_id = $_POST['submit_homework'];
			$sectionAction->submitHomework($hmwk_id, $mdb_control);
		}		
	}
	**/

echo "<div>";

	// Welcome headings
	$welcome = $sectionTables->getSectionWelcome($section_id, $mdb_control);	

echo "$welcome</div>";

echo "<div id='assignmentDiv' class='overflow'>";

	// List of assignments for this section
	$assignmentTables->displaySectionAssignments($section_id, $mdb_control, "student");

echo "</div>";
echo "<div id='demo'> </div>";
echo "<div id='homeworkDiv' class='overflow'>";

	// List of homework submitted for this section with links to view or download
	$assignmentTables->displayStudentHomework($section_id, $student_id, $mdb_control);

echo "</div>";

echo "<a id='bottom' href='#top'>return to top</a>";

?>



