<?php


$labs = array();
$labs = $mdb_control->getController("tutorial_lab")->getAllData();
$length_labs = count($labs);

echo '<h1 class="labs">Explore our Tutorial Labs!</h1>
	<div class="grid-container">';

if((!is_null($labs)) AND ($length_labs > 0))
{	
	for($i = 0; $i < $length_labs; $i++) 
	{
		$lab = $labs[$i];
		
		echo
		'<article class="labs">
			
			<h2>Tutorial ' . $lab->get_tutorial_lab_id() . ': ' . $lab->get_lab_name() . '</h2>';
			
		$status = $lab->get_lab_status();
		switch(	$status )
		{
			case 'Development':
				echo'<h1 class="development-status">In Development! Coming Soon!</h1>';
				break;
			case 'New':
				echo'<h1 class="new-status">NEW! Try it Now!</h1>';
				break;
			case 'Updated':
				echo'<h1 class="new-status">Updated and Improved!</h1>';
				break;
		}
			
		echo '<img class="labs" src=" images/labs/' . $lab->get_web_link() . '.png" alt="image of the lab">
		<p>' . $lab->get_introduction() . '</p>
		<h2>Student Rating: ??</h2>
		<h2>Professor Rating: ??</h2>
		<a class="labs" href="tutorial-information-page.php?num=' . $lab->get_tutorial_lab_id() . '&lab=' . $lab->get_web_link() . '">Learn More</a>
		</article>';
	}
	
}
else
{
	echo '<p> Error: no labs found.</p>';
}

echo '</div><br><a id="bottom" href="#top">return to top</a>';


?>