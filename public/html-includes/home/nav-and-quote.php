<?php

echo
'<nav class="site">		
	<a href="index.php">Home Page </a><hr>
	<a href="student.php">Student Pages</a><hr>
	<a href="professor.php">Professor Pages</a><hr>
	<a href="tutorial-labs.php">Tutorial Labs</a><hr>
	<a id="site" href="index.php#new-labs">See the Newest Tutorial Labs!</a><hr>
</nav>';

require('../private/database-access.php');

$query = 'select * from quote_of_the_month where quote_id = 101';

$result = mysqli_query($db_connection, $query);

if($result)
{
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo
		'<div class="quote">
			<h2 id="quote-title">Quote of the Month</h2>';
		
		echo	'<q id="quote">' . $row['quote'] . '</q>' .
				'<p id="quote-author">&#45; ' . $row['author'] . 
				'</p>
			<a id="quote-link" href="">Previous Quotes</a>
		</div>';
	}
	
	mysqli_free_result($result);		
}
else
{
	echo '<p>' . mysqli_error($db_connection) . '</p>';
}

mysqli_close($db_connection);

?>
