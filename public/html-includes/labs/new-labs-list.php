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
		$lab = $labs_new[$i];
		$web = $lab->get_tutorial_lab_web_link();
		
		echo '<article class="new-labs">
			<h2>' . $lab->get_tutorial_lab_name() . '</h2>
			<h1 class="new-status"> NEW! </h1>
			<img class="new-labs" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab" height="100">
			<p>' . $lab->get_tutorial_lab_introduction() . '</p>';
		echo '<p><a href="tutorial-information-page.php?num=' . $lab->get_tutorial_lab_id() . '&lab=' . $lab->get_tutorial_lab_web_link() . ">Learn More</a></p>
			</article>";
	}
	
	echo '<a id="bottom" href="index.php">return to top</a></section>';
}



?>
