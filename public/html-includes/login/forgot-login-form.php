
<?php

if(isset($_SESSION['found_member_id']))
{
	$part = $_SESSION['part'];
	
	switch ($part)
	{
		case "part2":
			include('html-includes/login/forgot-login-part2.html');
			break;
		case "part3":
			include('html-includes/login/forgot-login-part3.html');
			break;
		case "part4":
			// remove all session variables
			session_unset(); 
			session_destroy();
			
			echo '<div><br>				
					<h2>Thank you, your new password has been saved.</h2>
					<h2>You can now <a href="login-register-page.php?form_type=login">
						Sign In</a>.<h2>
				</div>';
			break;
		default:
			include('html-includes/login/forgot-login-part1.html');
			break;
	}
}
else
{
	include('html-includes/login/forgot-login-part1.html');
}

?>

