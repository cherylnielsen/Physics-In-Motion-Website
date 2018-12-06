<?php

echo '<h1>Tutorial Labs Currently Available</h1>';
	
require('../private/database-access.php');
$query = 'select * from tutorial_lab';
$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo
		'<article class="labs">
			<img src=" images/' . $row['web_link'] . '.png" alt="image of the lab">
			<h2>' . $row['lab_name'] . '</h2>
			<h2 class="lab-status">' . $row['lab_status'] . '!</h2>
			<p>' . $row['short_description'] . '</p>
			<p><a href="">Learn More</a></p>
		</article>';
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p> Oops! </p><br><p>' . mysqli_error($db_connection) . '</p>';
}

echo '<br><a id="bottom" href="tutorial-labs.php">return to top</a>';

mysqli_close($db_connection);

?>