<?php

$web_link = $_GET["lab"];
$tutorial_lab_id = $_GET["num"];

$labs = array();
$labs = $mdb_control->getController("tutorial_lab")->getByAttribute("tutorial_lab_id", "$tutorial_lab_id");

if((!is_null($labs)) AND (count($labs) > 0))
{	
	$lab = array();
	$lab = $labs[0];
	
	echo '<h1 class="labs">Tutorial ' . $lab->get_tutorial_lab_id() . ' : ' . $lab->get_lab_name() . '</h1>';
	
	echo
	'<div class="grid-lab-info">
	<img class="lab-info" src="images/labs/' . $lab->get_web_link() . '.png" alt="image of the lab">
	<article class="lab-info">';
		
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
				
	echo'<p>' . $lab->get_introduction() . '</p>
	<h2>Average time to complete: ??</h2>
	<h2>Student Rating: ??</h2>
	<h2>Professor Rating: ??</h2>	
	<p><a id="unity-link" href="">Start this lab now!</a></p>
	</article>';
	
	echo 
	'<article class="lab-info">
		<h2>Prerequisites</h2>
		<p>to be determined</p>
		<h2>Key Topics</h2>
		<p>to be determined</p>
	</article>';
	
	echo 
	'<article class="lab-info">
		<h2>Key Equations</h2>
		<p>to be determined</p>
	</article>';
	
	echo 
	'<img class="lab-info" src="images/labs/' . $lab->get_web_link() . '.png" alt="image of the lab">
	<img class="lab-info" src="images/labs/' . $lab->get_web_link() . '.png" alt="image of the lab">';
	
	echo 
	'<article class="lab-info">
		<h2>Discription</h2>
		<p>to be determined</p>
	</article>';
	
	echo 
	'<article class="lab-info">
		<h2>Instructions</h2>
		<p>to be determined</p>
	</article>';
	
	echo '</div><a id="bottom" href="#top">return to top</a>';
}
else
{
	echo '<h2>Oops! Lab could not be found.</h2>';
}


?>