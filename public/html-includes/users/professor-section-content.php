<?php

/**
 - List of assigned labs with Professor & due date
 - List of completed labs
 - Links to data download, math, graphs, screen shots, etc. from completed labs.
 - Links to download lab summaries with recommendations for problems encountered, time taken to complete the lab, etc.
 - Links to send a Notice of Lab Completion to a Professor that assigned a lab.
 - Links to rate completed labs.
**/

if(!isset($_SESSION['professor_id']))
{
	$url = "login-page.php";
	header("Location: $url");
	exit();
}

// The classes needed to interact with the database and 
// display the responses as html.
require_once('../private/member_page_include_list.php');

$professor_id = $_SESSION['professor_id'];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

$section_id = $_GET["section_id"];
$controller = $mdb_control->getController("section_view");
$section = $controller->getByPrimaryKey("section_id", $section_id);

// Welcome headings
$section_name = $section->get_section_name();
$school_name = $section->get_school_name();		
$date_time = $section->get_start_date();
$start_date = $displayUtility->displayDate($date_time);
$date_time = $section->get_end_date();
$end_date = $displayUtility->displayDate($date_time);

echo "<h2 class=welcome>Welcome $first_name $last_name!</h2>
		<h2 class=welcome>$school_name | Section $section_id : 
		$section_name | from $start_date to $end_date</h2>";

// Tables of links to other sections and section related actions
echo "<nav class='secondary-navigation'>";
$section_list = array();
$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
$sectionDisplay->displaySectionShortList($section_list, $mdb_control);
$displayUtility->displaySectionActions();
echo "</nav>";

// List of students that are members of this section
echo "<div id='studentListDiv'>";
$sectionDisplay->displaySectionStudentList($section_id, $mdb_control);
echo "</div>";

// List of assignments for this section with links to homework submitted
echo "<div id='assignmentListDiv'>";
$assignment_list = array();
$assignment_list = $assignmentDisplay->getSectionAssignments($section_id, $mdb_control);
$num = count($assignment_list);
$assignmentDisplay->displaySectionAssignments($section_id, $assignment_list, $mdb_control);
echo "$num assignment</div>";

/*
$noticeDisplay->displaySectionNoticeTable($section_list, $mdb_control);
echo "<br>";

$member_notice_list = array();
$member_notice_list = $noticeDisplay->getMemberInBoxNotices($professor_id, $mdb_control);
$noticeDisplay->displayMemberInBoxNoticeTable($member_notice_list, $mdb_control);
echo "<br>";

$member_notice_list = array();
$member_notice_list = $noticeDisplay->getMemberSentNotices($professor_id, $mdb_control);
$noticeDisplay->displayMemberSentNoticeTable($member_notice_list, $mdb_control);
echo "<br>";
*/

echo '<br><a id="bottom" href="#top">return to top</a>';


?>