<?php

//include scripts
include 'connectDB.php';

//variables
$SUCCESS_REDIRECT_LOCATION = "newEvent.php?msg=success";
$FAILURE_REDIRECT_LOCATION = "newEvent.php?msg=failure";
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

function insertAndRedirect($event_name, $event_code){
	$sql = "INSERT INTO event_list VALUES (" . $event_name . ', ' . $event_code . ')';
	echo $sql;
	if ($conn->query($sql) === TRUE) {
		header('Location: '.$REDIRECT_LOCATION.'?msg=success');
	}
	else{
		header('Location: '.$REDIRECT_LOCATION.'?msg=failure');
	}
}

//main
$event_name = $_POST['event_name'];
$event_code = generateRandomString();
insertAndRedirect($event_name, $event_code);
?>

