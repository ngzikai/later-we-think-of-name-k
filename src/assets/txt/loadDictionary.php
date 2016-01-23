<?php
include 'connectDB.php';

$file_handle = @fopen("http://laterk.stellarmen.com/assets/txt/dictionary.txt", "r");
if ($file_handle) {
    while (($line = fgets($file_handle, 4096)) !== false) {
        echo $line;

        $sql = "INSERT INTO dictionary (entry, used)
                VALUES (".$line.", 0)";

       /* $success = mysql_query($sql);

        if($succcess){
            echo $line. " was added successfully! :)";
        }else{
            echo $line . " was not added successfully :(.";
        }*/


    }
    if (!feof($file_handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($file_handle);
}