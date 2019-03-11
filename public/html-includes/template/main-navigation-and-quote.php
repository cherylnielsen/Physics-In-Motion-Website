<?php

$quote = $mdb_control->getController("quote")->getQuoteOfTheMonth();
?>

<aside class="nav-quote">
	<nav class="navigation">		
		<a id="home_pg_link" href="index.php" class="navigation">Home Page</a><hr>
		<a id="labs_pg_link" href="full-tutorial-labs-page.php" class="navigation">
			Tutorial Labs</a><hr>
		
		<a id="student_pg_link" href="student-page.php" 
				class="navigation">Student Pages</a><hr>
	
		<a id="professor_pg_link" href="professor-page.php" 
				class="navigation">Professor Pages</a><hr>

<?php	
	if(isset($_SESSION["administrator_id"]))
	{
		echo '<a id="admin_main_pg_link" href="administrator-page.php" 
				class="navigation">Admin Main</a><hr>';
	
		echo '<a id="admin_section_pg_link" href="admin-section-page.php" 
				class="navigation">Admin Sections</a><hr>';
	}
	
	if(isset($quote))
	{
		echo
			"<div class='quote'>
				<h2 id='quote-title'>Quote of the Month</h2>
				<q id='quote'>" . $quote->get_quote_text() . "</q>
					<p id='quote-author'>by " . $quote->get_author() . "</p>
				<a id='quote-link' href='quote-page.php'>Previous Quotes</a>
			</div>";
	}
?>

</nav></aside>


