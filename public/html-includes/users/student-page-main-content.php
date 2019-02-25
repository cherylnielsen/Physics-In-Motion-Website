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
	if(!isset($_SESSION['professor_id']))
	{
		$url = "login-page.php";
		header("Location: $url");
		exit();
	}
	else
	{
		$url = "professor-page.php";
		header("Location: $url");
		exit();
	}
}


$student_id = $_SESSION['student_id'];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

$dataUtility = new MemberDataUtilities();
$displayUtility = new MemberDisplayUtilities();
$displayTables = new MemberDisplayTables();

echo "<h1 class=user-page>Welcome $first_name $last_name!</h1>";

$section_list = array();
$section_list = $dataUtility->getSectionList_ByStudent($student_id, $mdb_control);
$displayTables->displaySectionTable($section_list);
echo "<br>";

$displayTables->displaySectionSummary_ByStudent($student_id, $section_list, $mdb_control);
echo "<br>";


/***
$notices_received = array();
$notices_received = $dataUtility->getSectionInBoxNotices($section_list, $mdb_control);
$notices_sent = array();
$notices_sent = $dataUtility->getMemberSentNotices($student_id, $mdb_control);
$displayTables->displayNoticeLists($notices_received, $notices_sent);
echo "<br>";
***/
 
echo '<br><a id="bottom" href="#top">return to top</a>';


?>