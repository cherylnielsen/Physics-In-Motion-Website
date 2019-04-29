<?php

	require_once('../private/user_display/RatingTables.php');
	
	$ratingTables = new RatingTables();
	$labs_new = array();
	$labs_control = $mdb_control->getController("tutorial_lab");
	$labs_new = $labs_control->getByAttribute("lab_status", "New");
	$length_labs_new = count($labs_new);
	$rating_info = array();


	if((!is_null($labs_new)) AND ($length_labs_new > 0))
	{	
		echo "<section class='new_labs'>
		<a id='new_labs' href='index.php' class='top_link'>return to top</a>";	
		
		for($i = 0; $i < $length_labs_new; $i++) 
		{	
			$web = $labs_new[$i]->get_tutorial_lab_web_link();
			$name = $labs_new[$i]->get_tutorial_lab_name();
			$intro = $labs_new[$i]->get_tutorial_lab_introduction();
			$lab_id = $labs_new[$i]->get_tutorial_lab_id();
			
			echo "<article class='new_labs'>
				<div class='new_labs'>
				<h2 class='new_labs'>Tutorial Lab $lab_id<br>$name</h2>
				<h1 class='red new_labs'>NEW!</h1>
				</div>
				<img class='new_labs' src='images/labs/$web.png' 
						alt='image of the lab' height='100'>
				<p class='new_labs'>$intro</p>";
				
			$rating_info = $ratingTables->getAveLabRating($lab_id, $mdb_control);	
			
			if($rating_info['num'] > 0) 
			{ 
				$ratingTables->outputStars($rating_info);			
			}	
			else
			{
				echo "<h2>Not yet rated.</h2>";
			}
			
			echo "<p><a href='tutorial-information-page.php?num=$lab_id" . 
						"&lab=$web'>Learn More Now!</a></p>
				</article>";
		}
		
		echo "<a class='top_link' href='index.php'>return to top</a></section>";
	}


?>
