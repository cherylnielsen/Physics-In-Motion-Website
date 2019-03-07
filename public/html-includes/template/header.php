<?php

	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	echo
	'<header>
		<div class="logo">	
			<a id="top" href="index.php"><h1>&nbsp;</h1></a>
			<h1 class="logo-print-view">Physics in Motion</h1><!-- text for print view only-->
			<!--Used background image instead of img tag because it was the only way to get correct automatic 
			resizing of width when using a fixed hight in all of the tested browser types.-->
		</div>';
	
	if(!isset($_SESSION['member_id']))
	{
		echo
		'<div class="sign-in">
			<a href="login-page.php">Sign In</a><br>
			<a href="register-page.php">Create Account</a>		
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

