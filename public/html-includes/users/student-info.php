<?php

/**
 - List of assigned labs with Professor & due date
 - List of completed labs
 - Links to data download, math, graphs, screen shots, etc. from completed labs.
 - Links to download lab summaries with recommendations for problems encountered, time taken to complete the lab, etc.
 - Links to send a Notice of Lab Completion to a Professor that assigned a lab.
 - Links to rate completed labs.
**/

if(!isset($_SESSION['user_id']))
{
	$url = "login-page.php";
	header("Location: $url");
	exit();
}

$student_id = $_SESSION['user_id'];
$first_name = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];

echo '<h1>Welcome ' . $first_name . ' ' . $last_name . '!</h1>';

/* get the data for the tables */



/*  build the table to display in html */
		
echo
'<h2>Tutorial Lab Homework</h2>
<table class="homework-table">
	
</table>';	
		

echo '<br><a id="bottom" href="#top">return to top</a>';
mysqli_close($db_connection);

?>