<?php


If($_SERVER['REQUEST_METHOD'] =='POST')
{
	$user_name = trim($_POST['user_name']);
	$password = trim($_POST['password']);
	$errors = array();

	if(empty($user_name))
	{
		$user_name = null;
		$errors[] = 'Please enter user name.';
	}
	else if(is_numeric($user_name))
	{
		$user_name = null;
		$errors[] = 'User name cannot be a number.';
	}
	
	if(empty($password))
	{
		$user_name = null;
		$errors[] = 'Please enter password.';
	}
	else if(is_numeric($password))
	{
		$user_name = null;
		$errors[] = 'Password cannot be a number.';
	}
		
	if(!empty($errors))
	{
		echo'<div class="form-errors"><p><em>Errors:</em></p><ul>';
		foreach($errors as $e)
		{
			echo "<li><em>$e</em></li>";
		}
		echo'</ul></div>';
	}
}

?>