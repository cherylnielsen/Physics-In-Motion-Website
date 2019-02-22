<?php

require_once('login-utilities.php'); 
	
If($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$login_utility = new LoginUtilities();
	
	$membername = $_POST['membername'];
	$password = $_POST['password'];
	// clear post info for security
	$_POST = array();
	
	echo'<div class="form-errors" id="action_errors">';
	
	if(is_null($membername) || is_null($password))
	{
		echo'<p>Error: Please enter member name and password.</p>';
	}
	else
	{
		// Trim to remove white space before or after input.
		$membername = trim($membername);
		$password = trim($password);
		
		if (empty($membername) || empty($password))
		{
			echo'<p>Error: Please enter member name and password.</p>'; 
		}
		else
		{
			$db_connect = get_db_connection();
			$membername = mysqli_real_escape_string($db_connect, $membername);
			$password = mysqli_real_escape_string($db_connect, $password);
			$member = $login_utility->authenticate_login($membername, $password, $mdb_control);
			
			if(is_null($member))
			{
				echo'<p>Error: Member name or password not found. <br> Please check spelling and try again.</p>';
			}
			else
			{
				$member_id = $member->get_member_id();
				$member_type = $member->get_member_type();
				$user = $login_utility->get_user($member_id, $member_type, $mdb_control);	
				
				if(!is_null($user))
				{	 
					if (session_status() == PHP_SESSION_NONE) 
					{
						session_start();
					}
					
					$ok = $login_utility->update_last_login($member, $mdb_control);
					$_SESSION['member_id'] = $member_id;
					$_SESSION['first_name'] = $member->get_first_name();
					$_SESSION['last_name'] = $member->get_last_name();	
					$_SESSION['complete'] = $member->get_registration_complete();
					
					switch($member_type)
					{
						case "student":
							$_SESSION['student_id'] = $member_id;
							$_SESSION['school_name'] = $user->get_school_name();
							$url = "student-page.php";
							break;
						case "professor":
							$_SESSION['professor_id'] = $member_id;
							$_SESSION['school_name'] = $user->get_school_name();
							$url = "professor-page.php";
							break;
						case "administrator":
							$_SESSION['admin_id'] = $member_id;
							$_SESSION['admin_type'] = $user->get_admin_type();
							$url = "administrator-page.php";
							break;
					}
					
					if(!$_SESSION['complete'])
					{
						$url = "complete_registration_page.php";
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