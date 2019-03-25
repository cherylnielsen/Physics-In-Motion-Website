<?php

	$form_errors = " ";
	$cancelURL = $noticeAction->returnURL();	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$is_ok = $noticeAction->processWriteNoticeForm($mdb_control, $form_errors);
		
		if($is_ok)
		{	
			header("Location: $cancelURL");
			exit();
		}	
	}
	
?>	