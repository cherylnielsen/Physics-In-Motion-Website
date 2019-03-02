<?php

/**
 - List of assigned labs with Professor & due date
 - List of completed labs
 - Links to data download, math, graphs, screen shots, etc. from completed labs.
 - Links to download lab summaries with recommendations for problems encountered, time taken to complete the lab, etc.
 - Links to send a Notice of Lab Completion to a Professor that assigned a lab.
 - Links to rate completed labs.
**/

if(!isset($_SESSION['student_id']))
{
	$url = "login-page.php";
	header("Location: $url");
	exit();
}

$student_id = $_SESSION['student_id'];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

$dataUtility = new MemberDataUtilities();
$displayUtility = new MemberDisplayUtilities();
$displaySections = new DisplaySectionData();
$displayNotices = new DisplayNotices();

echo "<h1 class=user-page>Welcome $first_name $last_name!</h1>";

$section_list = array();
$section_list = $dataUtility->getSectionList_ByStudent($student_id, $mdb_control);
$displaySections->displaySectionTable($section_list, $mdb_control);
echo "<br>";

$displaySections->displaySectionSummary_ByStudent($student_id, $section_list, $mdb_control);
echo "<br>";

$displayNotices->displaySectionNoticeTable($section_list, $mdb_control);
echo "<br>";
 
echo '<br><a id="bottom" href="#top">return to top</a>';


?>