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

$data_utility = new Member_Data_Utilities();
$display_utility = new Member_Display_Tables();
$display_summaries = new Member_Display_Summaries();


echo "<h1 class=user-page>Welcome $first_name $last_name!</h1>";


// Get the user data and display it in tables.
// Notices - received & sent - listed with links to display
// Sections - with assignments & homework links & submission links	

$section_list = array();
$section_list = $data_utility->get_sections_by_student($student_id, $mdb_control);

$display_utility->display_section_table($section_list);
echo "<br>";

$notices_received = array();
$notices_received = $data_utility->get_notices_received_by_section($section_list, $mdb_control);
$notices_sent = array();
$notices_sent = $data_utility->get_notices_sent_by_member($student_id, $mdb_control);

$display_utility->display_notice_table($notices_received, $notices_sent);
echo "<br>";

$assignment_list = array();
$assignment_list = $data_utility->get_assignments_by_section($section_list, $mdb_control);
$homework_list = array();
$homework_list = $data_utility->get_homeworks_by_student($student_id, $mdb_control);
$submission_list = array();
$submission_list = $data_utility->get_submissions_by_homework($homework_list, $mdb_control);

$display_summaries->display_section_summary($section_list, $assignment_list, $homework_list, $submission_list);
echo "<br>";
 
echo '<br><a id="bottom" href="#top">return to top</a>';


?>