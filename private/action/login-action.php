<?php

require_once('login-utilities.php'); 
	
If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$login_utility = new LoginUtilities();
	
	// input safety checks
	$username = $login_utility->sanitize_input($_POST['username']);
	$password = $login_utility->sanitize_input($_POST['password']);
	$db_con = $mdb_control->get_db_connection();
	
	echo'<div class="form-errors" id="action_errors">PHP';
	
	if(is_null($username) || is_null($password))
	{
		echo'<p>Error PHP: Please enter user name and password.</p>';
	}
	else if (empty($username) || empty($password))
	{
		echo'<p>Error PHP: Please enter user name and password.</p>';
	}
	else
	{
		$user = null;
		$ok = $login_utility->authenticate_login($user, $username, $password, $mdb_control);

		if(!$ok)
		{
			echo'<p>Error PHP: User name or password not found. <br> Please check spelling and try again.</p>';
		}
		else
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
				$info = $user_info[0];
				$first = $info->get_first_name();
				$last = $info->get_last_name();
			}
			
			session_start();
			$_SESSION['user_id'] = $user_id;
			$_SESSION['user_type'] = $user_type;
			$_SESSION['first_name'] = $first;
			$_SESSION['last_name'] = $last;
			
			$url = "index.php";
			header("Location: $url");
			exit();
		}

	}
	
	echo'</div>';
}


?>