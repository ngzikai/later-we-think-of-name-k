<?php
$servername = "localhost";
$username = "stellarm_laterk";
$password = "h44cknr00ll";
$dbname='stellarm_laterk';

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?> 
/**
 * Created by PhpStorm.
 * User: Zi Kai
 * Date: 23 Jan 2016
 * Time: 17:59
 */