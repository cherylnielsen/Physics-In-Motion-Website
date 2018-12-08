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
$first_name = "firstname";
$last_name = "lastname";

$assignment_array = array();
$homework_array = array();
$has_homework = array(); 
$notice_array = array();

$table_headings = array();
$table_headings['Assignments'] = ('assignment id', 'profesor', 'tutorial lab', 'due date', 'points', 'started', 'submitted', 'hours', 'additional instructions');
$table_headings['Homework'] = ('assignment id', 'summary', 'data', 'graphs', 'math', 'errors', 'full report', 'chat session');
$table_headings['Notices'] = ('notice id', 'assignment id', 'type', 'date', 'text');


echo '<h1>Hello ' . $first_name . ' ' . $last_name . '!</h1>';

$query = 'select * from assignments where student_id =' . $student_id . '';
$result = mysqli_query($db_connection, $query);

if($result)
{
	/* the assignment set */
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$lab_name = "";
		$profesor_name = "";
		$has_additional_instructions = "";
		
		$line = '<tr><td>' . $row['assignment_id'] . '</td><td>' . $row['profesor_id'] . '</td><td>' . $profesor_name . '</td><td>' . $row['lab_id'] . '</td><td>' . $lab_name . '</td><td>' . $row['date_assigned'] . '</td><td>' . $row['date_due'] . '</td><td>' . $row['lab_points'] . '</td><td>' . $row['date_started'] . '</td><td>' . $row['date_submitted'] . '</td><td>' . $row['total_time_spent'] . ' hours</td><td>' . $row['additional_instructions'] . '</td></tr>';
		
		$id = $row['assignment_id'];
		array_push($assignment_array, $line);	
		array_push($has_homework, $id => false);
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p> Oops, Sorry! </p><p>' . mysqli_error($db_connection) . '</p>';
}


$query = 'select * from student_homework where student_id =' . $student_id . '';
$result = mysqli_query($db_connection, $query);

if($result)
{
	/* the homework set */
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$line = '<tr><td>' . $row['assignment_id'] . '</td><td>' . $row['profesor_id'] . '</td><td>' . $row['lab_id'] . '</td><td>' . $row['date_assigned'] . '</td><td>' . $row['date_due'] . '</td><td>' . $row['lab_points'] . '</td><td>' . $row['date_started'] . '</td><td>' . $row['date_submitted'] . '</td><td>' . $row['total_time_spent'] . ' hours</td><td>' . $row['additional_instructions'] . '</td></tr>';
		
		$id = $row['assignment_id'];
		array_push($homework_array, $line);	
		$has_homework[$id] => true;
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p> Oops, Sorry! </p><p>' . mysqli_error($db_connection) . '</p>';
}





$query = 'select * from notifications where student_id =' . $student_id . '';
$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$line = '<tr><td>' . $row['assignment_id'] . '</td><td>' . $row['profesor_id'] . '</td><td>' . $row['lab_id'] . '</td><td>' . $row['date_assigned'] . '</td><td>' . $row['date_due'] . '</td><td>' . $row['lab_points'] . '</td><td>' . $row['date_started'] . '</td><td>' . $row['date_submitted'] . '</td><td>' . $row['total_time_spent'] . ' hours</td><td>' . $row['additional_instructions'] . '</td></tr>';
		
		array_push($notice_array, $line);				
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