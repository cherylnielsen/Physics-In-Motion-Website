<?php


/**
 - List of assigned labs with Professor & due date
 - List of completed labs
 - Links to data download, math, graphs, screen shots, etc. from completed labs.
 - Links to download lab summaries with recommendations for problems encountered, time taken to complete the lab, etc.
 - Links to send a Notice of Lab Completion to a Professor that assigned a lab.
 - Links to rate completed labs.
**/

/***
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

$user_id = $_SESSION['user_id'];
$professor_id = $_SESSION['professor_id'];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

***/

//test data for professor page
$user_id = 4;
$professor_id = 2;
$first_name = 'P1first-testing';
$last_name = 'P1last-testing';
// end test data


echo '<h2>Welcome Professor ' . $first_name . ' ' . $last_name . '!</h2>';

/* Get the data and display it in tables.*/
		
echo
'<h2>Tutorial Lab Homework</h2>
<table class="homework-table">
	
</table>';	
		

echo '<br><a id="bottom" href="#top">return to top</a>';


?>