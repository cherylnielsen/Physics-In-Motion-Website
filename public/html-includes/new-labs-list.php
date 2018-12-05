<?php

require('../private/database-access.php');
$query = 'select * from tutorial_lab where lab_status = "In Development" OR lab_status = "NEW"';
$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo
		'<article class="new-labs">
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

mysqli_close($db_connection);

?>
