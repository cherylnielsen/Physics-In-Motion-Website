<?php

$quote = $mdb_control->getController("quote")->getQuoteOfTheMonth();
$no_session = (session_status() == PHP_SESSION_NONE);

echo
'<aside class="nav-quote">
	<nav class="navigation">		
		<a id="home_pg_link" href="index.php">Home Page</a><hr>';
		
	if(!isset($_SESSION["professor_id"]))
	{
		echo '<a id="student_pg_link" href="student-page.php">Student Pages</a><hr>';
	}
	
	if(!isset($_SESSION["student_id"]))
	{
		echo '<a id="professor_pg_link" href="professor-page.php">Professor Pages</a><hr>'; 	
	}
	
	echo
		'<a id="labs_pg_link" href="full-tutorial-labs-page.php">Tutorial Labs</a><hr>
	</nav>';

if(!is_null($quote))
{
	echo
		"<div class='quote'>
			<h2 id='quote-title'>Quote of the Month</h2>
			<q id='quote'>" . $quote->get_quote_text() . "</q>
				<p id='quote-author'>&#45;" . $quote->get_author() . "</p>
			<a id='quote-link' href='quote-page.php'>Previous Quotes</a>
		</div>";
}
else
{
	echo '<p> Opps: error! </p>';
}

echo '</aside>';


?>
