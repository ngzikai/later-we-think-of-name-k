<?php
$servername = "localhost";
$username = "stellarm_laterk";
$password = "h44cknr00ll";
$dbname='stellarm_laterk';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?> 
