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

$display_utility = new Member_Display_Tables();
$data_utility = new Member_Data_Utilities();


echo "<h1 class=user-page>Welcome $first_name $last_name!</h1>";


// Get the user data and display it in tables.
// Notices - received & sent - listed with links to display
// Sections - with assignments & homework links & submission links	

$section_list = array();
$section_list = $data_utility->get_sections_by_professor($professor_id, $mdb_control);
$display_utility->display_section_table($section_list);

echo "<br>";

$notices_received = array();
$notices_received = $data_utility->get_notices_by_section($section_list, $mdb_control);
$num = count($notices_received);

$notices_sent = array();
$notices_sent = $data_utility->get_notices_by_member($professor_id, $mdb_control);

$display_utility->display_notice_table($notices_received, $notices_sent);

echo "<br>";

$assignment_list = array();
$assignment_list = $data_utility->get_assignments_by_section($section_list, $mdb_control);
$display_utility->display_assignment_table($assignment_list);

echo "<br>";

$homework_list = array();
$homework_list = $data_utility->get_homeworks_by_assignment($assignment_list, $mdb_control);
$display_utility->display_homework_table($homework_list);

echo "<br>";

$submission_list = array();
$submission_list = $data_utility->get_submissions_by_assignment($assignment_list, $mdb_control);
$display_utility->display_submission_table($submission_list);

echo "<br>";
echo '<br><a id="bottom" href="#top">return to top</a>';


?>