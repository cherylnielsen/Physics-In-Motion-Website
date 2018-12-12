<?php


$data_type = "tutorial_lab";
$labs = array();
$labs = $mdb_control->get_all($data_type);
$length_labs = count($labs);

echo '<h1>Tutorial Labs Currently Available</h1>';

if((!is_null($labs)) AND ($length_labs > 0))
{	
	for($i = 0; $i < $length_labs; $i++) 
	{
		$lab = $labs[$i];
		
		echo
		'<article class="labs">
			<img src=" images/labs/' . $lab->get_web_link() . '.png" alt="image of the lab">
			<h2>Tutorial ' . $lab->get_lab_id() . ': ' . $lab->get_lab_name() . '</h2>';
			
		$status = $lab->get_lab_status();
		switch(	$status )
		{
			case 'In Development':
				echo'<h1 class="development-status">' . $status . '!</h1>';
				break;
			case 'New':
				echo'<h1 class="new-status">' . $status . '!</h1>';
				break;
		}
			
		echo '<p>' . $lab->get_short_description() . '</p>
		<h2>Rating: to be determined</h2>
		<p><a href="tutorial-information-page.php?num=' . $lab->get_lab_id() . '&lab=' . $lab->get_web_link() . '">Learn More</a></p>
		</article>';
	}
	
	
}
else
{
	echo '<p> Oops! Error: no labs found.</p>';
}

echo '<br><a id="bottom" href="#top">return to top</a>';


?>