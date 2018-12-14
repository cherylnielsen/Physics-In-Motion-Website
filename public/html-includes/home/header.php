<?php

	session_start();

	echo
	'<div class="large-logo">	
		<a id="top" href="index.php"><h1>&nbsp;</h1></a>
		<!--background="images/3D logo Physics in Motion 12 2 18.png"
			Used background instead of img because it was the only way to get correct automatic resizing of width when using a fixed hight in all of the tested brower types.-->
			
		<h1 class="large-logo">Physics in Motion</h2><!-- for print view only-->
	</div>';
	
	if(!isset($_SESSION['user_id']))
	{
		echo
		'<div class="login">
			<a id="sign-in" href="login-page.php">Sign In</a><br>
			<a id="register" href="register-page.php">Create Account</a>		
		</div>';
	}
	else
	{
		echo
		'<div class="login">
			<p class="welcome">Hello  ' .$_SESSION["first_name"] . '</p><br>
			<a id="logout" href="html-includes/login/logout.php">Sign Out</a>			
		</div>';
	}
	
	
?>
