<?php
$servername = "localhost";
$username = "stellarm_laterk";
$password = "P@ssword01";
$dbname='stellarm_laterk';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connection_error){
	die('Connection to database failed: '.$conn->connect_error);
}
?> 
