<?php 
    
    //$servername = "localhost:3306"; // not needed
    //$servername = "localhost";
    //$username = "root";
    //$password = "sfsu@2019Grad";
	//$database = "physics_in_motion";
    
    // Create connection
    $db_connection = mysqli_connect('localhost', 'root', 'sfsu@2019Grad', 'physics_in_motion') OR die (mysqli_connect_error());
    
	/**
	if (mysqli_ping($db_connection))
	{
		echo 'MySQL Server' . mysqli_get_server_info($db_connection) . ' on ' . mysqli_get_host_info($db_connection);
	}
	**/
	
	$query = 'show tables';
	$result = mysqli_query($db_connection, $query);
	
	if($result)
	{
		echo '<h1>We got a database! Result set returned OK!</h1>';
		echo '<h2>Tables on the database:</h2>';
		
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			echo '<br>' . $row[0];
		}
		
		mysqli_free_result($result);		
	}
	else
	{
		echo '<p>' . mysqli_error($db_connection) . '</p>';
	}
	
	mysqli_close($db_connection);
	
?> 

