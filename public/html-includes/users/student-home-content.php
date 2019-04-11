<?php

$section_list = array();
$section_list = $sectionTables->getSectionList_ByStudent($student_id, $mdb_control);
$sectionTables->displaySectionMembershipTable($section_list, $mdb_control, "student");

echo "<div id='homeworkSummaryDiv' class='overflow'>";

	$assignmentTables->displayNumAssignmentsDueSoon($section_list, $mdb_control);

echo "</div>";
echo "<div id='noticeSummaryDiv' class='overflow'>";

	$noticeTables->displayNoticeSummary($student_id, $section_list, $mdb_control);

echo "</div>";
echo "<a id='bottom' href='#top'>return to top</a>";

?>