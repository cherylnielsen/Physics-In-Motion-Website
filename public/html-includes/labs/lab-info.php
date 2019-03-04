<?php

$web_link = $_GET["lab"];
$tutorial_lab_id = $_GET["num"];

$labs = array();
$labs = $mdb_control->getController("tutorial_lab")->getByAttribute("tutorial_lab_id", "$tutorial_lab_id");

if((!is_null($labs)) AND (count($labs) > 0))
{	
	$lab = array();
	$lab = $labs[0];
	
	$status = $lab->get_lab_status();
	$introduction = $lab->get_tutorial_lab_introduction();
	
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
	
	echo '<h1 class="labs">Tutorial Lab ' . $lab->get_tutorial_lab_id() . ' : ' . $lab->get_tutorial_lab_name() . '</h1>';
	
	echo
	'<div class="grid-lab-info">	
	<article class="lab-info">
		<img class="left" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab">';
		
	echo "<div> $status" ;	
				
	echo'<p>' . $introduction . '</p>
			<h3>Average time to complete: ??</h3>
			<h3>Average Student Rating: ??</h3>
			<h3>Average Professor Rating: ??</h3>	
			<p><a id="unity-link" href="">Start this lab now!</a></p>
		</div>
	</article>';
	
	echo 
	'<article class="lab-info">
		<img class="right" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab">
		<div>
			<h2>Prerequisites</h2>
			<p>' . $introduction . '</p>
			<h2>Key Topics</h2>
			<p>' . $introduction . '</p>
			<h2>Key Equations</h2>
			<p>' . $introduction . '</p>
		</div>
	</article>';

	echo 
	'<article class="lab-info">
		<img class="left" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab">
		<div>
			<h2>Discription</h2>
			<p>' . $introduction . '</p>
			<p>' . $introduction . '</p>
			<p>' . $introduction . '</p>
		</div>
	</article>';
	
	echo 
	'<article class="lab-info">
		<img class="right" src="images/labs/' . $lab->get_tutorial_lab_web_link() . '.png" alt="image of the lab">
		<div>
			<h2>Instructions</h2>
			<p>' . $introduction . '</p>
			<p>' . $introduction . '</p>
			<p>' . $introduction . '</p>
		</div>
	</article>';
	
	echo '</div><a id="bottom" href="#top">return to top</a>';
}
else
{
	echo '<h2>Oops! Lab could not be found.</h2>';
}


?>