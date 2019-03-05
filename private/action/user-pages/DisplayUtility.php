<?php

class DisplayUtility
{	
	public function __construct() {}
	
	
	public function displayDateTime($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date_time = date("D, M d, Y g:i A", $time);
			return $formated_date_time;
		}		
		
		return null;
	}
	
	
	public function displayDate($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date = date("D, M d, Y", $time);
			return $formated_date;
		}		
		
		return null;
	}
	
	
	public function displayBoolean($oneZero)
	{
		if($oneZero)
		{
			return "Yes";
		}
		else
		{
			return "No";
		}			
	}
	
	
	
	
	
}

 
?>