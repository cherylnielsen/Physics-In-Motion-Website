
<aside class="nav-quote">
	<nav class="navigation">	
		<h2 class='navigation main-nav'>Main Navigation</h2>
		
		<a href="index.php" class="navigation">Home Page</a>		
		
		<a href="full-tutorial-labs-page.php" 
				class="navigation">Tutorial Labs</a>		
						
		<a href="student-home-page.php" 
				class="navigation">Student Pages</a>				
			
		<a href="professor-home-page.php" 
				class="navigation">Professor Pages</a>	

		<?php
		
		if(isset($_SESSION['administrator_id']) && $_SESSION['admin_type'])
		{		
			echo "<a href='admin-home-page.php' 
					class='navigation'>Administration Pages</a>";
		}
		
		include('html-includes/navigation/admin-navigation.php');
		include('html-includes/navigation/professor-navigation.php');  
		include('html-includes/navigation/student-navigation.php');	 
		
		?>	
		
	</nav>	
	
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


