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
$user_id = $_SESSION['student_id'];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

echo "<h2>Welcome $first_name $last_name!</h2>";

// Get the user data and display it in tables.
// Notices - received & sent - listed with links to display
// Sections - with assignments & homework links & submission links	



echo '<br><a id="bottom" href="#top">return to top</a>';


?>