<?php

require_once('../private/MasterDatabaseController.php');

echo
'<nav class="site">		
	<a href="index.php">Home Page </a><hr>
	<a href="student-page.php">Student Pages</a><hr>
	<a href="professor-page.php">Professor Pages</a><hr>
	<a href="tutorial-labs-page.php">Tutorial Labs</a><hr>
	<a id="site" href="index.php#new-labs">See the Newest Tutorial Labs!</a><hr>
</nav>';


$mdb_control = new MasterDatabaseController();
$quote = $mdb_control->get_quote_of_the_month();



if (isset($quote)) {
    echo "This var is set so I will print.";
}
if (null === ($quote->get_author())) {
    echo "This var is NULL so I will print.";
}
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


?>
