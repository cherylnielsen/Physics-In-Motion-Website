
<aside class="nav-quote">
	<nav class="navigation">	
		<h2 class='navigation'>Main Navigation</h2>
		
		<a id="home_pg_link" href="index.php" class="navigation">Home Page</a>		
		<a id="labs_pg_link" href="full-tutorial-labs-page.php" 
			class="navigation">	Tutorial Labs</a>		
		<a id="student_pg_link" href="student-page.php" 
				class="navigation">Student Pages</a>	
		<a id="professor_pg_link" href="professor-page.php" 
				class="navigation">Professor Pages</a>
		
	</nav>
	
	<?php	
	
		if(isset($_SESSION["administrator_id"]) && isset($_SESSION["member_type"]))
		{
			if($_SESSION["member_type"] == "administrator")
			{
				include('html-includes/navigation/admin-navigation.php');
			}
		}
		
		if(isset($_SESSION["professor_id"]) && isset($_SESSION["member_type"]))
		{
			if($_SESSION["member_type"] == "professor")
			{
				include('html-includes/navigation/professor-navigation.php');
			}
		}
		
		if(isset($_SESSION["student_id"]) && isset($_SESSION["member_type"]))
		{
			if($_SESSION["member_type"] == "student")
			{
				include('html-includes/navigation/student-navigation.php');
			}
		}
	?>
	
	
	
	<div class='quote'>
		<?php	
			$quote = $mdb_control->getController("quote")->getQuoteOfTheMonth();
			if(isset($quote))
			{
				echo "<h2 id='quote-title'>Quote of the Month</h2>
						<q id='quote'>" . $quote->get_quote_text() . "</q>
						<p id='quote-author'>by " . $quote->get_author() . "</p>
					<a id='quote-link' href='quote-page.php'>Previous Quotes</a>";
			}
		?>
	</div>
</aside>


