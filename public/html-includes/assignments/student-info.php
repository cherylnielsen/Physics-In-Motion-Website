<?php

$student_id = 101;

require('../private/database-access.php');
$query = 'select * from assignments where student_id =' . $student_id . '';
$result_labs = mysqli_query($db_connection, $query);
$query = 'select * from student_homework where student_id =' . $student_id . '';
$result_homework = mysqli_query($db_connection, $query);
$query = 'select * from notifications where student_id =' . $student_id . '';
$result_notices = mysqli_query($db_connection, $query);

/**
 - List of assigned labs with Professor & due date
 - List of completed labs
 - Links to data download, math, graphs, screen shots, etc. from completed labs.
 - Links to download lab summaries with recommendations for problems encountered, time taken to complete the lab, etc.
 - Links to send a Notice of Lab Completion to a Professor that assigned a lab.
 - Links to rate completed labs.
**/

if($result)
{
	while ($row = mysqli_fetch_array($result_labs, MYSQLI_ASSOC))
	{
		echo '<h1>Hello ' . $row['first_name'] . ' ' . $row['last_name'] . '!</h1>';
		
		echo
		'<article class="labs">
			<h1 class="lab-status">' . $row['lab_status'] . '!</h1>
			<p>' . $row['short_description'] . '</p>';
			
		echo '<h2>Rating: to be determined</h2>
		<p><a id="unity-link" href="">Start this lab now.</a></p>
		</article>';
		
		echo 
		'<section class="lab-details">
		<h2>Average time to complete</h2>
		<p>to be determined</p>
		</section>';
		
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p> Oops! </p><br><p>' . mysqli_error($db_connection) . '</p>';
}

echo '<br><a id="bottom" href="#top">return to top</a>';
mysqli_close($db_connection);

?>