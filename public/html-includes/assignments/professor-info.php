<?php


$db_connection = $mdb_control->get_db_connection();

$professor_id = 101;


$query = 'select * from professor where professor_id =' . $professor_id . '';
$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo '<h1>Hello ' . $row['first_name'] . ': ' . $row['last_name'] . '</h1>';
		
		/**
		echo
		'<article class="labs">
			<img src=" images/labs/' . $row['web_link'] . '.png" alt="image of the lab">
			<h1 class="lab-status">' . $row['lab_status'] . '!</h1>
			<p>' . $row['short_description'] . '</p>';
			
		echo '<h2>Rating: to be determined</h2>
		<p><a id="unity-link" href="">Start this lab now.</a></p>
		</article>';
		**/
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