<?php

require_once('../private/user_display/RatingTables.php');
	
$ratingTables = new RatingTables();
$labs = array();
$labs = $mdb_control->getController("tutorial_lab")->getAllData();
$length_labs = count($labs);

echo '<h1 class="logo-statement">An interactive 3D Tutorial Lab experience<br> 
		for Students of Physics and Engineering.</h1>';
echo "<div class='grid-container'>";

if((!is_null($labs)) AND ($length_labs > 0))
{	
	for($i = 0; $i < $length_labs; $i++) 
	{
		$lab = $labs[$i];
		$id = $lab->get_tutorial_lab_id();
		$name = $lab->get_tutorial_lab_name();
		$link = $lab->get_tutorial_lab_web_link();
		$img_link = "images/labs/$link" . ".png";
		$page_link = "tutorial-information-page.php?num=" . $id . "&lab=" . $link;
		$intro = $lab->get_tutorial_lab_introduction();
		
	?>

	<article class="card center">
		<a class='card' href='<?php echo "$page_link"; ?>'>			
			<img class="card" src='<?php echo "$img_link"; ?>' alt="image of the lab">				
			<h3 class='card'><?php echo "Tutorial Lab $id : $name"; ?></h3>
		</a>
	
		<div class="card-status">			
	<?php	
		$status = $lab->get_lab_status();
		
		switch(	$status )
		{
			case 'Development':
				echo'<h3 class="green">Coming Soon!</h3>';
				break;
			case 'New':
				echo'<h3 class="red">NEW!</h3>';
				break;
			case 'Updated':
				echo'<h3 class="red">Updated!</h3>';
				break;
		}
	?>	
		</div>
		
		<div class="card-intro">
			<a class='card' href='<?php echo "$page_link"; ?>'>
				<h3 class="card-link">Learn More!</h3> </a>
			<p class='card'><?php echo "$intro"; ?></p>
		</div>				
		
		<div class="card-ratings">	
	
	<?php	
		$rating_info = $ratingTables->getAveLabRating($id, $mdb_control);
		
		if($rating_info['num'] > 0) 
		{ 
			$ratingTables->outputStars($rating_info);			
		}	
		else
		{
			echo "<h2 class='red'>Not yet rated.</h2>";
		}
		
		echo '</div></article>';
	}
}
else
{
	echo '<p> Error: no labs found. </p>';
}

echo '</div><br><a id="bottom" href="#top">return to top</a>';


?>