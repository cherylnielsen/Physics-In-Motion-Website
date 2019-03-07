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
	
	
	public function displayDateLong($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date = date("D, M d, Y", $time);
			return $formated_date;
		}		
		
		return null;
	}
	
	
	public function displayDateShort($date_time)
	{
		if(isset($date_time))
		{
			$time = strtotime($date_time);
			$formated_date = date("D, m/d/y", $time);
			return $formated_date;
		}		
		
		return null;
	}
	
	
}
 
?>