<?php

class UserUtilities
{
	public function __construct() {}
	
	
	get_all_assignment_info($user)
	{
		$assignments = array();
		$data_type = "assignment";
		$attribute_type = "student_id";
		$attribute_value = $user_id;
		return $assignments;
	}
	
	
	get_all_homework_info($user_id)
	{
		$homeworks = array();
		
		return $homeworks;
	}
	
	
	get_all_notice_info($user_id)
	{
		$notices = array();
		
		return $notices;
	}
	
	
	get_assignment($user_id, $assignment_id)
	{
		
	}
	
	
	get_homework($user_id, $assignment_id)
	{
		
	}
	
	
	get_notice($user_id, $assignment_id)
	{
		
	}
	
	
}

/**





$labs = array();
$labs = $mdb_control->get_by_attribute($attribute_value, $attribute_type, $data_type);
$length_labs = count($labs);

if((!is_null($labs)) AND ($length_labs > 0))
{	
	for($i = 0; $i < $length_labs; $i++) 
	{	
		$lab = $labs[$i];
		echo '<hr><article class="assignment">
				<h2>' . $lab->get_lab_name() . '</h2>
			</article><hr>';
	}
}
else
{
	echo '<p> No new labs. </p>';
}
**/

?>

