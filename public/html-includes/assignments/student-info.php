<?php

require('../private/database-access.php');


/**
 - List of assigned labs with Professor & due date
 - List of completed labs
 - Links to data download, math, graphs, screen shots, etc. from completed labs.
 - Links to download lab summaries with recommendations for problems encountered, time taken to complete the lab, etc.
 - Links to send a Notice of Lab Completion to a Professor that assigned a lab.
 - Links to rate completed labs.
**/

$student_id = 101;
$assignment_id = 101;
$first_name = "firstname";
$last_name = "lastname";

$assignment_array = array();
$homework_array = array();
$has_homework = array(); 
$notice_array = array();



echo '<h1>Hello ' . $first_name . ' ' . $last_name . '!</h1>';

$query = "select * from assignment where student_id = $student_id ";
$result = mysqli_query($db_connection, $query);

if($result)
{
	/* the assignment set */
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo '<p> an assignment was found </p>';
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p> Oops, Sorry! </p><p>' . mysqli_error($db_connection) . '</p>';
}


$query = "select * from homework where homework_id = $assignment_id ";
$result = mysqli_query($db_connection, $query);

if($result)
{
	/* the homework set */
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo '<p> a homework was found </p>';
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p> Oops, Sorry! </p><p>' . mysqli_error($db_connection) . '</p>';
}


$query = "select * from notice where assignment_id = $assignment_id ";
$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
			echo '<p> a notice was found </p>';
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p> Oops, Sorry! </p><p>' . mysqli_error($db_connection) . '</p>';
}


/*  build the table to display in html */
		
echo
'<h2>Tutorial Lab Homework</h2>
<table class="homework-table">
	
</table>';	
		

echo '<br><a id="bottom" href="#top">return to top</a>';
mysqli_close($db_connection);

?>