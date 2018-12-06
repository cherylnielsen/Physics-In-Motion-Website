<?php

$web_link = $_GET["lab"];
$lab_id = $_GET["num"];

require('../private/database-access.php');
$query = 'select * from tutorial_lab where lab_id =' . $lab_id . '';
$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo '<h1>Tutorial ' . $row['lab_id'] . ': ' . $row['lab_name'] . '</h1>';
		
		echo
		'<article class="labs">
			<img src=" images/labs/' . $row['web_link'] . '.png" alt="image of the lab">
			<h1 class="lab-status">' . $row['lab_status'] . '!</h1>
			<p>' . $row['short_description'] . '</p>';
			
		echo '<p><a id="unity-link" href="">Start this lab now.</a></p>
		</article>';
		
		echo 
		'<section class="lab-details">
		<h2>Prerequisites</h2>
		<p>to be determined</p>
		<h2>Key Topics</h2>
		<p>to be determined</p>
		<h2>Key Equations</h2>
		<p>to be determined</p>
		<h2>Discription</h2>
		<p>to be determined</p>
		<h2>Instructions</h2>
		<p>to be determined</p>
		</section>';
		
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