<?php
$file_handle = @fopen("http://laterk.stellarmen.com/assets/txt/dictionary.txt", "r");
if ($file_handle) {
    while (($line = fgets($file_handle, 4096)) !== false) {
        echo $line."<br>";
    }
    if (!feof($file_handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($file_handle);
}