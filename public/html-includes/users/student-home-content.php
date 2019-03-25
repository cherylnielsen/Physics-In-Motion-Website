
<?php
$section_list = array();
$section_list = $sectionDisplay->getSectionList_ByStudent($student_id, $mdb_control);
$sectionDisplay->displaySectionMembershipTable($section_list, $mdb_control, "student");
?>

<div id='homeworkSummaryDiv' class='overflow'>
<?php
	$assignmentDisplay->displayNumAssignmentsDueSoon($section_list, $mdb_control);
?>
</div>

<div id='noticeSummaryDiv' class='overflow'>
<?php
	$noticeDisplay->displayNoticeSummary($student_id, $section_list, $mdb_control)
?>
</div>

<a id="bottom" href="#top">return to top</a>
