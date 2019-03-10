<?php

$quote = $mdb_control->getController("quote")->getQuoteOfTheMonth();

echo
'<aside class="nav-quote">
	<nav class="navigation">		
		<a id="home_pg_link" href="index.php" class="navigation">Home Page</a><hr>
		<a id="labs_pg_link" href="full-tutorial-labs-page.php" class="navigation">
			Tutorial Labs</a><hr>';
		
	if(!isset($_SESSION["professor_id"]))
	{
		echo '<a id="student_pg_link" href="student-page.php" class="navigation">Student Pages</a><hr>';
	}
	
	if(!isset($_SESSION["student_id"]))
	{
		echo '<a id="professor_pg_link" href="professor-page.php" class="navigation">Professor Pages</a><hr>'; 	
	}
	
if(isset($quote))
{
	echo
		"<div class='quote'>
			<h2 id='quote-title'>Quote of the Month</h2>
			<q id='quote'>" . $quote->get_quote_text() . "</q>
				<p id='quote-author'>&#45;" . $quote->get_author() . "</p>
			<a id='quote-link' href='quote-page.php'>Previous Quotes</a>
		</div>";
}

echo '</aside>';

?>
