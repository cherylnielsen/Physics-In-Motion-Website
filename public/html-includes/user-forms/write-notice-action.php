<?php

	$form_errors = " ";
	$error_array = array();
	$cancelURL = $noticeAction->returnURL();	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_ok = $noticeAction->processWriteNoticeForm($mdb_control, $error_array);
		
		if($is_ok)
		{	
			$homeURL = "http://localhost/Physics-in-Motion/" . $cancelURL;
			
			echo "<script type='text/javascript'>
					window.location = $homeURL;
				</script>";
			echo "<h2 class='center'>SUCCESS: The notice has been sent. </h2>";
			
			//header("Location: $cancelURL");
			exit();
		}
		else
		{
			$form_errors .= "<h2>ERROR: </h2>";
			
			for($i = 0; $i < count($error_array); $i++)
			{
				$form_errors .= "<p>" . $error_array[$i] . "</p>";
			}
		}
		
	}
	
?>	