<?php


$labs_new = array();
$labs_new = $mdb_control->getController("tutorial_lab")->getByAttribute("lab_status", "New");
$length_labs_new = count($labs_new);

if((!is_null($labs_new)) AND ($length_labs_new > 0))
{	
	echo '<section class="new-labs">
	<a id="new-labs" href="index.php">return to top</a>	
	<h1 class="new-labs">New Tutorial Labs!</h1>
	<hr><article class="new-labs">';
	
	for($i = 0; $i < $length_labs_new; $i++) 
	{	
		$lab = $labs_new[$i];
		
		echo '<h2>' . $lab->get_lab_name() . '</h2>
			<h1 class="new-status"> NEW! </h1>
			<p>' . $lab->get_short_description() . '</p>';
		echo '<p><a href="tutorial-information-page.php?num=' . $lab->get_lab_id() . '&lab=' . $lab->get_web_link() . '">Learn More</a></p>';
	}
	
	echo '</article><hr>
	<a id="bottom" href="index.php">return to top</a>
	</section>';
}



?>
