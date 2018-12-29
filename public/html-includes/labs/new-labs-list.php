<?php


$data_type = "tutorial_lab";
$attribute_type = "lab_status";
$attribute_value = "NEW";
$labs_new = array();
$labs_new = $mdb_control->get_by_attribute($attribute_value, $attribute_type, $data_type);
$labs_indevelopment = array();
$attribute_value = "In Development";
$labs_indevelopment = $mdb_control->get_by_attribute($attribute_value, $attribute_type, $data_type);

		
echo '<section class="new-labs">
	<a id="new-labs" href="index.php">return to top</a>	
	<h1 class="new-labs">Tutorial Labs: New or Currently in Development</h1>';

$length_labs_new = count($labs_new);

if((!is_null($labs_new)) AND ($length_labs_new > 0))
{	
	for($i = 0; $i < $length_labs_new; $i++) 
	{	
		$lab = $labs_new[$i];
		echo '<hr><article class="new-labs">
				<h2>' . $lab->get_lab_name() . '</h2>';
				
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
				<p><a href="tutorial-information-page.php?num=' . $lab->get_lab_id() . '&lab=' . $lab->get_web_link() . '">Learn More</a></p>
			</article><hr>';
	}
}

$length_indevelopment = count($labs_indevelopment);

if((!is_null($labs_indevelopment)) AND ($length_indevelopment > 0))
{		
	for($i = 0; $i < $length_indevelopment; $i++) 
	{	
		$lab = $labs_indevelopment[$i];
		echo '<hr><article class="new-labs">
				<h2>' . $lab->get_lab_name() . '</h2>';
				
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
				<p><a href="tutorial-information-page.php?num=' . $lab->get_lab_id() . '&lab=' . $lab->get_web_link() . '">Learn More</a></p>
			</article><hr>';
	}
}

if((is_null($labs_new)) AND ($length_labs_new <= 0) AND (is_null($labs_indevelopment)) AND ($length_indevelopment <= 0))
{
	echo '<h2>No new labs currently. Check back soon!</h2>';
}


echo '<a id="bottom" href="index.php">return to top</a>
</section>';


?>
