<?php

$theQuotes = array();
$theQuotes = $mdb_control->getController("quote")->getAllData();
$num_theQuotes = count($theQuotes);

echo "<h1>Previous and Current Quotes of the Month</h1>";

if((!is_null($theQuotes)) AND ($num_theQuotes > 0))
{	
	for($i = 0; $i < $num_theQuotes; $i++) 
	{
		$theQuotes[$i];
		
		echo
		"<article class='previous-quote'>
			<q>" . $theQuotes[$i]->get_quote_text() . "</q>
			<p>&#45;" . $theQuotes[$i]->get_author() . "</p>
		</article>";		
	}	
}

?>