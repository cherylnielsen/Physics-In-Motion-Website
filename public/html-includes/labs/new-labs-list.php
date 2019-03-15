<?php


$labs_new = array();
$labs_new = $mdb_control->getController("tutorial_lab")->getByAttribute("lab_status", "New");
$length_labs_new = count($labs_new);

if((!is_null($labs_new)) AND ($length_labs_new > 0))
{	
	echo '<section class="new-labs">
	<a id="new-labs" href="index.php">return to top</a>	
	<h1 class="new-status">New Tutorial Labs!</h1><hr>';
	
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
			
		echo '<p><a href="tutorial-information-page.php?num=' . $lab_id . 
					'&lab=' . $web . '">Learn More</a></p>';
		echo '</article>';
	}
	
	echo '<a id="bottom" href="index.php">return to top</a></section>';
}



?>
