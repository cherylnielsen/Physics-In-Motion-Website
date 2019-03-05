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

$professor_id = $_SESSION['professor_id'];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

// The classes needed to interact with the database and 
// display the responses as html.
require_once('../private/member_page_include_list.php');

echo "<h1 class=welcome>Welcome $first_name $last_name!</h1>";

echo "<p>Click on a section to view more information.<p>";

$section_list = array();
$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
$sectionDisplay->displaySectionMembershipTable($section_list, $mdb_control);
echo "<br>";

echo "<p>Click on a notice type for more information.<p>";

$noticeDisplay->displayNoticeSummary($professor_id, $section_list, $mdb_control);
echo "<br>";

/*
$sectionDisplay->displaySectionSummary_ByProfessor($professor_id, $section_list, $mdb_control);
echo "<br>";

$sectionDisplay->displaySectionStudentList($section_list, $mdb_control);
echo "<br>";

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