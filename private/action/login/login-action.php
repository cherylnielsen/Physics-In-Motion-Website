<?php

require_once('login-utilities.php'); 
	
If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$login_utility = new LoginUtilities();
	
	// By standard convention, user name and password are not sanitized.
	// Instead, they are directly encrypted and verified using built in PHP functions.
	$username = $_POST['username'];
	$password = $_POST['password'];
	// clear post info for security
	$_POST = array();
	
	echo'<div class="form-errors" id="action_errors">';
	
	if(is_null($username) || is_null($password))
	{
		echo'<p>Error: Please enter user name and password.</p>';
	}
	else
	{
		// Trim to remove white space before or after input.
		$username = trim($username);
		$password = trim($password);
		
		if (empty($username) || empty($password))
		{
			echo'<p>Error: Please enter user name and password.</p>'; 
		}
		else
		{
			$user = $login_utility->authenticate_login($username, $password, $mdb_control);
			
			if(is_null($user))
			{
				echo'<p>Error: User name or password not found. <br> Please check spelling and try again.</p>';
			}
			else
			{
				$user_id = $user->get_user_id();
				$member_type = $user->get_user_type();
				$member = $login_utility->get_member($user_id, $member_type, $mdb_control);	
				$user_id = $member->get_user_id();
				
				if(!is_null($member))
				{	 
					if (session_status() == PHP_SESSION_NONE) 
					{
						session_start();
					}
					
					$ok = $login_utility->update_last_login($user, $mdb_control);
					$_SESSION['user_id'] = $user_id;
					$_SESSION['ok'] = $ok;
					$_SESSION['first_name'] = $member->get_first_name();
					$_SESSION['last_name'] = $member->get_last_name();	
					
					switch($member_type)
					{
						case "student":
							$_SESSION['student_id'] = $user_id;
							$url = "student-page.php";
							break;
						case "professor":
							$_SESSION['professor_id'] = $user_id;
							$url = "professor-page.php";
							break;
						case "administrator":
							$_SESSION['admin_id'] = $user_id;
							$url = "administrator-page.php";
							break;
					}
					
					header("Location: $url");
					exit();
				}
			}
		}
	}
	
	echo'</div>';
	
}


?>