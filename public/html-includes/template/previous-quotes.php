<?php

$theQuotes = array();
$theQuotes = $mdb_control->getController("quote")->getAllData();
$num_theQuotes = count($theQuotes);

if((!is_null($theQuotes)) AND ($num_theQuotes > 0))
{	
	echo "<section class='quotes'>
			<h1 class='quotes'>Previous and Current Quotes of the Month</h1>";
			
	for($i = 0; $i < $num_theQuotes; $i++) 
	{
		echo
		"<article class='quotes'>
			<q>" . $theQuotes[$i]->get_quote_text() . "</q>
			<p> by " . $theQuotes[$i]->get_author() . "</p>
		</article>";		
	}	
	echo "<br></section>";
}

?>