<?php
include 'connectDB.php';

$file_handle = @fopen("http://laterk.stellarmen.com/assets/txt/dictionary.txt", "r");
if ($file_handle) {
    while (($line = fgets($file_handle, 4096)) !== false) {
    	$trim = trim($line);
        //echo $trim;

        $sql = "INSERT INTO dictionary (entry, used)
                VALUES (".$trim.", 0)";


        if($conn->query($sql) or die($conn->error()){
            echo $trim. " was added successfully! :)";
        }else{
            echo $trim . " was not added successfully :(<br>";
        }


    }
    if (!feof($file_handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($file_handle);
}