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
	
	
	public function displaySectionActions()
	{
		echo "<table class='summary actions'>
				<tr><th>Actions</th></tr>";
				
		echo "<tr><td><button class='summaryButton' onclick='showStudentList();'>
				Show/Hide Student List</button></td></tr>";
		echo "<tr><td><button class='summaryButton' onclick='showAssignmentList();'>
				Show/Hide Assignment List</button></td></tr>";
		echo "<tr><td><button class='summaryButton' onclick='addSectionAssignment();'>
				Add Assignment</button></td></tr>";
		echo "<tr><td><button class='summaryButton' onclick='showSectionNotices();'>
				Show/Hide Section Notices</button></td></tr>";
		echo "<tr><td><button class='summaryButton' onclick='addSectionNotice();'>
				Write Section Notice</button></td></tr>";
		
		echo "</table>";
	}
	
	
}
 
?>