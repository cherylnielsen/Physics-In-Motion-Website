<?php

$quote = $mdb_control->getController("quote")->getQuoteOfTheMonth();

echo
'<aside class="nav-quote">
	<nav class="navigation">		
		<a id="home" href="index.php">Home Page</a><hr>
		<a href="student-page.php">Student Pages</a><hr>
		<a href="professor-page.php">Professor Pages</a><hr>		
		<a href="tutorial-labs-page.php">Tutorial Labs</a><hr>
	</nav>';

if(!is_null($quote))
{
	echo
		"<div class='quote'>
			<h2 id='quote-title'>Quote of the Month</h2>
			<q id='quote'>" . $quote->get_quote_text() . "</q>
				<p id='quote-author'>&#45;" . $quote->get_author() . "</p>
			<a id='quote-link' href=''>Previous Quotes</a>
		</div>";
}
else
{
	echo '<p> Opps: error! </p>';
}

echo '</aside>';
?>
