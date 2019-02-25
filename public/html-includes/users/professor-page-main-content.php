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
	if(!isset($_SESSION['student_id']))
	{
		$url = "login-page.php";
		header("Location: $url");
		exit();
	}
	else
	{
		$url = "student-page.php";
		header("Location: $url");
		exit();
	}
}


$professor_id = $_SESSION['professor_id'];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

$dataUtility = new MemberDataUtilities();
$displayUtility = new MemberDisplayUtilities();
$displayTables = new MemberDisplayTables();

echo "<h1 class=user-page>Welcome $first_name $last_name!</h1>";

$section_list = array();
$section_list = $dataUtility->getSectionList_ByProfessor($professor_id, $mdb_control);
$displayTables->displaySectionTable($section_list);
echo "<br>";

$notices_received = array();
$notices_received = $dataUtility->getSectionInBoxNotices($section_list, $mdb_control);
$notices_sent = array();
$notices_sent = $dataUtility->getMemberSentNotices($professor_id, $mdb_control);
$displayTables->displayNoticeLists($notices_received, $notices_sent);
echo "<br>";

$assignment_list = array();
$assignment_list = $dataUtility->getSectionAssignments($section_list, $mdb_control);
$displayTables->display_assignment_table($assignment_list);
echo "<br>";

$homework_list = array();
$homework_list = $dataUtility->getAssignmentHomework($assignment_list, $mdb_control);
$displayTables->display_homework_table($homework_list);
echo "<br>";

echo '<br><a id="bottom" href="#top">return to top</a>';


?>