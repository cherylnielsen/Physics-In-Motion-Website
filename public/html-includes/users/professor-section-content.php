<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$sectionAction->processTableForms($mdb_control);
}		
	
echo "<div>";

	// Welcome headings
	$welcome = $sectionTables->getSectionWelcome($section_id, $mdb_control);	

echo "$welcome</div>";

echo "<div id='studentDiv' class='overflow'>";

	// List of students that are members of this section
	// need to add grades and stats for each student (second or same table?)
	$studentTables->displayStudents($section_id, $mdb_control);

echo "</div>";

echo "<div id='assignmentDiv' class='overflow'>";

	// List of assignments for this section
	$assignmentTables->displaySectionAssignments($section_id, $mdb_control, "professor");

echo "</div>";

echo "<div id='homeworkDiv' class='overflow'>";

	// List of homework submitted for this section with links to view or download
	$assignmentTables->displaySubmittedHomework($section_id, $mdb_control);

echo "</div>";

echo "<div id='studentGradeDiv' class='overflow'>";

	// List of students that are members of this section
	// with the grades and stats for each student
	$studentTables->displayStudentGrades($section_id, $mdb_control);

echo "</div>";

echo "<a id='bottom' href='#top'>return to top</a>";

?>


