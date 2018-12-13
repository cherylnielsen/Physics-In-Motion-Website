<?php

$web_link = $_GET["lab"];
$lab_id = $_GET["num"];

$data_type = "tutorial_lab";
$attribute_type = "lab_id";
$attribute_value = $lab_id;
$labs = array();
$labs = $mdb_control->get_by_attribute($attribute_value, $attribute_type, $data_type);

$length_labs = count($labs);

if((!is_null($labs)) AND ($length_labs > 0))
{	
	for($i = 0; $i < $length_labs; $i++) 
	{
		$lab = $labs[$i];
		
		echo '<h1>Tutorial ' . $lab->get_lab_id() . ': ' . $lab->get_lab_name() . '</h1>';
		
		echo
		'<article class="labs">
			<img src=" images/labs/' . $lab->get_web_link() . '.png" alt="image of the lab">';
			
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
					
		echo'<p>' . $lab->get_short_description() . '</p>
		<h2>Rating: to be determined</h2>
		<p><a id="unity-link" href="">Start this lab now.</a></p>
		</article>';
		
		echo 
		'<section class="lab-details">
		<h2>Average time to complete</h2>
		<p>to be determined</p>
		<h2>Prerequisites</h2>
		<p>to be determined</p>
		<h2>Key Topics</h2>
		<p>to be determined</p>
		<h2>Key Equations</h2>
		<p>to be determined</p>
		<h2>Discription</h2>
		<p>to be determined</p>
		<h2>Instructions</h2>
		<p>to be determined</p>
		</section>';
		
	}
		
}
else
{
	echo '<h2>Oops! Lab could not be found.</h2>';
}

echo '<br><a id="bottom" href="#top">return to top</a>';


?>