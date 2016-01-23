<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

include 'connectDB.php';

$file_handle = @fopen("http://laterk.stellarmen.com/assets/txt/dictionary.txt", "r");
if ($file_handle) {
    while (($line = fgets($file_handle, 4096)) !== false) {
    	$trim = trim($line);
        //echo $trim;

        $sql = "INSERT INTO dictionary 
                VALUES '".$trim."'";

        echo $sql . "<br>";
        /*
		if ($conn->query($sql) === TRUE) {
		    echo $trim;
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}*/


    }
    if (!feof($file_handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($file_handle);
}