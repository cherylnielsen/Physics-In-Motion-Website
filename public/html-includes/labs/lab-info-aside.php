<?php

echo '<section class="lab-info-aside">
	<a id="new-labs" href="index.php">return to top</a>	
	<h1>Lab Information</h1>';

require('../private/database-access.php');
$query = 'select * from tutorial_lab where lab_id =' . $lab_id . '';
$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo
		'<hr><article class="lab-info-aside">
			<h2>' . $row['lab_name'] . '</h2>
			<h2 class="lab-status">' . $row['lab_status'] . '!</h2>
			<p>' . $row['short_description'] . '</p>
			<p><a href="">Learn More</a></p>
		</article><hr>';
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p> Oops! </p><br><p>' . mysqli_error($db_connection) . '</p>';
}

echo '</section>';
mysqli_close($db_connection);

?>
