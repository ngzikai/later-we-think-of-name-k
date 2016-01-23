<?php

//include scripts
include 'connectDB.php';

//variables
$SUCCESS_REDIRECT_LOCATION = "newEvent.php?msg=insert success";
$FAILURE_REDIRECT_LOCATION = "index.php?msg=insert failed";

//functions
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function insertEvent($event_name, $event_code, $conn){
	$sql = "INSERT INTO event_list (event_name, event_code) VALUES ('" . $event_name . "', '" . $event_code . "')";
	return ($conn->query($sql) === TRUE);
}

//main
$event_name = $_POST['event_name'];
$event_code = generateRandomString();
$insertEventSuccess= insertEvent($event_name, $event_code, $conn);

if ($insertEventSuccess){
	header('Location: ' . $SUCCESS_REDIRECT_LOCATION);
}
else{
		header('Location: ' . $FAILURE_REDIRECT_LOCATION);
}
	
die();
?>

