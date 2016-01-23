<?php
$servername = "localhost";
$username = "stellarm_laterk";
$password = "h44cknr00ll";
$dbname='stellarm_laterk';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?> 
