<?php

include('../private/user_display/RatingDisplay.php');
	
$ratingDisplay = new RatingDisplay();
$labs = array();
$labs = $mdb_control->getController("tutorial_lab")->getAllData();
$length_labs = count($labs);

echo '<h1 class="labs">Explore our Tutorial Labs!</h1><br>
	<div class="grid-container">';

if((!is_null($labs)) AND ($length_labs > 0))
{	
	for($i = 0; $i < $length_labs; $i++) 
	{
		$lab = $labs[$i];
		
		echo
		'<article class="card">
			<a class="card" 
			href="tutorial-information-page.php?num=' . $lab->get_tutorial_lab_id() . '&lab=' . $lab->get_tutorial_lab_web_link() . '">';
			
		echo '<img class="card" src=" images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" 
			alt="image of the lab">';
			
		echo '<div class="card-title">
				<h3>Tutorial Lab ' . $lab->get_tutorial_lab_id() . '</h3>
				<h3>' . $lab->get_tutorial_lab_name() . '</h3>
				</div>';
		
		echo '<div class="card-status">';		
		$status = $lab->get_lab_status();
		
		switch(	$status )
		{
			case 'Development':
				echo'<h3 class="development-status">Coming Soon!</h3>';
				break;
			case 'New':
				echo'<h3 class="new-status">NEW!</h3>';
				break;
			case 'Updated':
				echo'<h3 class="new-status">Updated!</h3>';
				break;
		}
		echo '</div>';
		
		echo '<div class="card-intro">
				<h3 class="card-link">Learn More!</h3>
				<p>' . $lab->get_tutorial_lab_introduction() . '</p></div>';				
		
		echo '<div class="card-ratings">';	
		
		$rating_info = $ratingDisplay->getAveLabRating($lab->get_tutorial_lab_id(), $mdb_control);
		
		if($rating_info['num'] > 0) 
		{ 
			$ratingDisplay->outputStars($rating_info);			
		}	
		else
		{
			echo "<h2 class='red'>Not yet rated.</h2>";
		}
		
		
		echo '</div></a></article>';
	}
	
}
else
{
	echo '<p> Error: no labs found.</p>';
}

echo '</div><br><a id="bottom" href="#top">return to top</a>';


?>