<?php

require_once('login-utilities.php'); 
	
If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$login_utility = new LoginUtilities();
	$username = $login_utility->validate_username($_POST['username'], $db_connection);
	$password = $login_utility->validate_password($_POST['password'], $db_connection);
	$stayin = null;
	
	if(isset($_POST['password']))
	{
		$stayin = $_POST['password'];
	}
	
	$user = $login_utility->authenticate_login($username, $password, $mdb_control);

	if(!is_null($user) && !empty($user->get_user_id()))
	{
		$user_id = $user->get_user_id();	
		$user_type = $user->get_user_type();
		$first;
		$last;
		
		$user_info = array();
		$user_info = $login_utility->get_user_info($user_id, $user_type, $mdb_control);		
		$length = count($user_info);

		if((!is_null($user_info)) AND ($length > 0))
		{	
			for($i = 0; $i < $length; $i++) 
			{	
				$info = $user_info[$i];
				$first = $info->get_first_name();
				$last = $info->get_last_name();
			}
		}
		
		session_start();
		$_SESSION['user_id'] = $user_id;
		$_SESSION['user_type'] = $user_type;
		$_SESSION['first_name'] = $first;
		$_SESSION['last_name'] = $last;
		
		
		echo'<div class="form-errors">
			<p><em>Yes! You are in Physics in Motion!</em></p>
			<p>user_type is ' . $_SESSION['user_type'] . '</p>
			<p>first_name is ' . $_SESSION['first_name'] . '</p>
			<p>last_name is ' . $_SESSION['last_name'] . '</p>
			</div>';
		
	}	
	else
	{
		echo'<div class="form-errors">
		<p><em>Error: User name or password not found.  Please check spelling and try again.</em>
		</p></div>';
	}


}




?>