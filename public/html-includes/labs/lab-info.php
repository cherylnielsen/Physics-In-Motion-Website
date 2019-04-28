<?php
require_once('../private/user_display/RatingTables.php');
$ratingTables = new RatingTables();

$web_link = $_GET["lab"];
$tutorial_lab_id = $_GET["num"];
$lab = $mdb_control->getController("tutorial_lab")->getByPrimaryKey("tutorial_lab_id", "$tutorial_lab_id");

if(isset($lab))
{	
	$status = $lab->get_lab_status();
	$introduction = $lab->get_tutorial_lab_introduction();
	$ave_time = $ratingTables->averageTimeToComplete($tutorial_lab_id, $mdb_control);
	
	switch(	$status )
	{
		case 'Development':
			$status = '<h1 class="development-status">In Development! Coming Soon!</h1>';
			break;
		case 'New':
			$status = '<h1 class="new-status">NEW! Try it Now!</h1>';
			break;
		case 'Updated':
			$status = '<h1 class="new-status">Updated and Improved!</h1>';
			break;
	}
	
	echo '<h1 class="labs-title">Tutorial Lab ' . $tutorial_lab_id . ' : ' . 
			$lab->get_tutorial_lab_name() . '</h1>';
	
	echo
	'<div class="grid-lab-info">	
	<article class="lab-info">
		<img class="left" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab">';
		
	echo "<div> $status" ;	
				
	echo'<p>' . $introduction . '</p>
			<h2>Average Time to Complete = ' . $ave_time . ' hours</h2>';
			
			$rating_info = $ratingTables->getAveLabRating($tutorial_lab_id, $mdb_control);	
			
			if($rating_info['num'] > 0) 
			{ 
				$ratingTables->outputStars($rating_info);			
			}	
			else
			{
				echo "<h2 class='red'>Not yet rated.</h2>";
			}	
			echo '<br><a href="#list-ratings">View Ratings</a><br>';
			
	echo'<h2><a id="unity-link" href="">Start this lab now!</a></h2>
		</div>
	</article>';
	
	echo 
	'<article class="lab-info">
		<img class="right" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab">
		<div>
			<h1>Prerequisites</h1>
			<p>' . $introduction . '</p>
			<h1>Key Topics</h1>
			<p>' . $introduction . '</p>
			<h1>Key Equations</h1>
			<p>' . $introduction . '</p>
		</div>
	</article>';

	echo 
	'<article class="lab-info">
		<img class="left" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab">
		<div>
			<h1>Discription</h1>
			<p>' . $introduction . '</p>
			<p>' . $introduction . '</p>
			<p>' . $introduction . '</p>
		</div>
	</article>';
	
	echo 
	'<article class="lab-info">
		<img class="right" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab">
		<div>
			<h1>Instructions</h1>
			<p>' . $introduction . '</p>
			<p>' . $introduction . '</p>
			<p>' . $introduction . '</p>
		</div>
	</article>';
	
	echo '<a href="#top" class="top-link">return to top</a>';
	
	echo 
	'<article class="lab-info">
		<h1 class="ratings-title">Tutorial Lab Ratings</h1><br>
		<div id="list-ratings" class="grid-lab-ratings">';
			$lab_name = $lab->get_tutorial_lab_name();
			$ratingTables->displayFullLabRatings($tutorial_lab_id, $lab_name, $mdb_control);
	echo '</div></article>';
		
	echo '<a href="#top" class="top-link">return to top</a>';
}
else
{
	echo '<h2>Sorry, the Tutorial Lab requested could not be found.</h2>';
}


?>