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

$dataUtility = new MemberDataUtilities();
$displayUtility = new MemberDisplayUtilities();
$displayTables = new DisplaySectionData();

echo "<h1 class=user-page>Welcome $first_name $last_name!</h1>";

$section_list = array();
$section_list = $dataUtility->getSectionList_ByProfessor($professor_id, $mdb_control);
$displayTables->displaySectionTable($section_list, $mdb_control);
echo "<br>";

$displayTables->displaySectionSummary_ByProfessor($professor_id, $section_list, $mdb_control);
echo "<br>";

$displayTables->displaySectionStudentLists($section_list, $mdb_control);
echo "<br>";

$section_notice_list = array();
$section_notice_list = $dataUtility->getSectionNotices($section_list, $mdb_control);
$displayTables->displaySectionNoticeList($section_notice_list);
echo "<br>";

$member_notice_list = array();
$member_notice_list = $dataUtility->getMemberSentNotices($professor_id, $mdb_control);
$displayTables->displayMemberNoticeList($member_notice_list);
echo "<br>";

$member_notice_list = array();
$member_notice_list = $dataUtility->getMemberInBoxNotices($professor_id, $mdb_control);
$displayTables->displayMemberNoticeList($member_notice_list);
echo "<br>";

echo '<br><a id="bottom" href="#top">return to top</a>';


?>