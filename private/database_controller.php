<?php

require('../private/database-access.php');
$query = 'select * from tutorial_lab';
$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo
		'<article class="labs">
			<img src=" images/labs/' . $row['web_link'] . '.png" alt="image of the lab">
			<h2>Tutorial ' . $row['lab_id'] . ': ' . $row['lab_name'] . '</h2>';
			
		$status = $row['lab_status'];
		switch(	$status )
		{
			case 'In Development':
				echo'<h1 class="development-status">' . $status . '!</h1>';
				break;
			case 'New':
				echo'<h1 class="new-status">' . $status . '!</h1>';
				break;
		}
			
		echo '<p>' . $row['short_description'] . '</p>
		<h2>Rating: to be determined</h2>
		<p><a href="tutorial-information.php?num=' . $row['lab_id'] . '&lab=' . $row['web_link'] . '">Learn More</a></p>
		</article>';
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