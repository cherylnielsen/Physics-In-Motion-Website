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
		echo '<section class="new-labs">
		<a id="new-labs" href="index.php">return to top</a>	
		<h1 class="new-labs-title">New Tutorial Labs!</h1>';
		
		for($i = 0; $i < $length_labs_new; $i++) 
		{	
			$web = $labs_new[$i]->get_tutorial_lab_web_link();
			$name = $labs_new[$i]->get_tutorial_lab_name();
			$intro = $labs_new[$i]->get_tutorial_lab_introduction();
			$lab_id = $labs_new[$i]->get_tutorial_lab_id();
			
			echo '<article class="new-labs">';
			echo '<h2>' . $name . '</h2>
				<h1 class="new-status"> NEW! </h1>
				<img class="new-labs" src="images/labs/' . $web . '.png" 
						alt="image of the lab" height="100">
				<p>' . $intro . '</p>';
				
			$rating_info = $ratingTables->getAveLabRating($lab_id, $mdb_control);	
			
			if($rating_info['num'] > 0) 
			{ 
				$ratingTables->outputStars($rating_info);			
			}	
			else
			{
				echo "<h2 class='red'>Not yet rated.</h2>";
			}
			
			echo '<p><a href="tutorial-information-page.php?num=' . $lab_id . 
						'&lab=' . $web . '">Learn More</a></p>';
			echo '</article>';
		}
		
		echo '<a id="bottom-new-labs" href="index.php">return to top</a></section>';
	}


?>
