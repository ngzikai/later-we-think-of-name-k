<?php
$servername = "localhost";
$username = "stellarm_laterk";
$password = "h44cknr00ll";
$dbname='stellarm_laterk';

// Create connection
$conn = mysqli_connect($servername, $username, $password);
if ($conn->connection_error){
	die('Connection to database failed: '.$conn->connect_error);
}
?> 
