<?php

require_once('../../private/DatabaseControllerFactory.php'); 
require_once('../../private/user_display/DataUtility.php');
require_once('../../private/user_action/FileAction.php');

function autoComplete()
{
	$mdb_control = new DatabaseControllerFactory();	
	$formAction = new SectionAction();	
	$word = $_POST["word"];
	$textID = $_POST["textID"];
	
	//nameList = get array of sections or students names/ids
	
	$nameList = array();

	// lookup $word in the array of possible values 
	if ($word !== "") 
	{
		$word = trim($word);
		foreach($nameList as $name) 
		{
			if (stripos($name, $word)) 
			{
				$nameList[] = $name;
			}
		}
	}

	return $nameList;
}

// The echo string of the result is then automatically returned
// as the AJAX response to the xhttp request.
echo autoComplete();

?>