<?php

	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	
	echo
	'<header>
		<div class="logo">	
			<a id="top" href="index.php"><h1>&nbsp;</h1></a>
			<!-- text for print view only-->
			<h1 class="logo-print-view">Physics in Motion</h1>
		</div>';
		
		
	if(!isset($_SESSION['member_id']))
	{
		echo
		'<div class="sign-in">
			<a href="login-register-page.php?form_type=login">Sign In</a><br>
			<a href="login-register-page.php?form_type=register">Create Account</a>		
		</div>';
	}
	else
	{
		echo
		'<div class="sign-in">
			<p class="welcome">Hello  ' .$_SESSION["first_name"] . ' ' .$_SESSION["last_name"] . '!</p><br>
			<a href="html-includes/login/logout.php">Sign Out</a>			
		</div>';
	}
	
	echo '</header>';
?>

