<?php

	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	
	echo '<header>';
		
	echo
		'<div class="logo">
			<a href="index.php" class="cornerLogo">
				<img class="cornerLogo" src="images/wide logo as of 2016.JPG" 
					alt="Physics In Motion">
			</a>		
				
			<a id="top" href="index.php">
				<h1 class="logo">Physics in Motion</h1>
			</a>
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

