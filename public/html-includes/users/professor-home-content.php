
<?php
$section_list = array();
$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
$sectionDisplay->displaySectionMembershipTable($section_list, $mdb_control, "professor");
?>

<div id='homeworkSummaryDiv' class='overflow'>
<?php
	$assignmentDisplay->displayNumAssignmentsDueSoon($section_list, $mdb_control);
?>
</div>

<div id='noticeSummaryDiv' class='overflow'>
<?php
	$noticeDisplay->displayNoticeSummary($professor_id, $section_list, $mdb_control)
?>
</div>

<a id="bottom" href="#top">return to top</a>


