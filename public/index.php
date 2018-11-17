<?php 
   // phpinfo(); 
    echo "oh dear using apache and mysql ";

    //$servername = "localhost:3306"; // not needed
    $servername = "localhost";
    $username = "root";
    $password = "sfsu@2019Grad";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully ";



$servername = "localhost";
$username = "root";
$password = "sfsu@2019Grad";

try {
    $conn = new PDO("mysql:host=$servername;dbname=sakila", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully "; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

  
?> 

