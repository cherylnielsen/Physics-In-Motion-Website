<?php

$theQuotes = array();
$theQuotes = $mdb_control->getController("quote")->getAllSortByDate();
$num_theQuotes = count($theQuotes);

if((!is_null($theQuotes)) AND ($num_theQuotes > 0))
{	
	echo "<section class='quotes'>
			<h1 class='quotes'>Previous and Current Quotes of the Month</h1>";
	
	$year = 2000;
	$currentYear = date("Y");
	$currentMonth = date("n");
	
	for($i = 0; $i < $num_theQuotes; $i++) 
	{
		$newYear = $theQuotes[$i]->get_year_posted();
		// if in a future year exit the loop
		if($newYear > $currentYear) { break; }
		
		$month = $theQuotes[$i]->get_month_posted();
		
		if($newYear > $year) 
		{ 
			$year = $newYear; 
			echo "<h1>$year</h1>
					<hr class='quotes'>";
		}
		
		if(($year < $currentYear) || (($year == $currentYear) && ($month <= $currentMonth)))
		{
			echo "<article class='quotes'>
					<q>" . $theQuotes[$i]->get_quote_text() . "</q>
					<p> by " . $theQuotes[$i]->get_author() . "</p>
				</article>";
			echo "<hr class='quotes'>";	
		}
	}	
	
	echo "<br></section>";
}

?>