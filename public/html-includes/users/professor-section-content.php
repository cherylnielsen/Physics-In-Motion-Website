<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['grade_homework_id']))
		{
			$id = $_POST['grade_homework_id'];
			$grade = $_POST["grade_$id"]; 
			$sucess = $assignmentAction->gradeHomework($id, $grade, $mdb_control);
		}		
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




