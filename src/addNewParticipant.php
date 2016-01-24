<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

include 'connectDB.php';

$shortlink = $_POST["shortlink"];
$eventCode = $_POST["event_code"];

$sqlInsert = "INSERT INTO event_participants (event_code, shortlink)
        		VALUES ('".$eventCode."', '".$shortlink."')";

if ($conn->query($sqlInsert) === TRUE) {
} else {
    echo "Error: " . $sqlInsert. "<br>" . $conn->error;
}

$selectSql = "SELECT * FROM event_participants
			WHERE event_code = '".$eventCode."'";

$result = $conn->query($selectSql);

$shortLinkArray = array();
$timeArray = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

//load shortLinks into shortLinksArray
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$shortLink = $row["shortlink"];
    	array_push($shortLinkArray, $shortLink);
    }
} else {
    echo "0 results";
}

//for each shortLink, process dates
//2 cases: start time < end time (easy case)
//start time > end time (hard case)

$noOfParticipant = sizeof($shortLinkArray);

foreach ($shortLinkArray as $sl) {
   $selectSql1 = "SELECT * FROM user_data
			WHERE shortlink = '".$sl."'";

	$result = $conn->query($selectSql1);
	$row = mysqli_fetch_assoc($result);

	$startTime = intval($row["starttime"]);
	$endTime = intval($row["endtime"]);
	$gmt = intval($row["gmt"]);

	$startTime = processTime($startTime, $gmt);
	$endTime = processTime($endTime, $gmt);

	echo $startTime;
	echo $endTime;
	echo $gmt;

	if($startTime < $endTime){
		while($startTime != $endTime){
			$timeArray[$startTime] = $timeArray[$startTime] + 1;
			$startTime++;
		}
	}elseif($startTime == $endTime){
		$timeArray[$startTime] = $timeArray[$startTime] + 1;
	}else{
		while($startTime != 24){
			$timeArray[$startTime] = $timeArray[$startTime] + 1;
			$startTime++;
		} 

		$startTime = 0;

		while($startTime != $endTime){
			$timeArray[$startTime] = $timeArray[$startTime] + 1;
			$startTime++;
		} 
	}
}

$newStartRange = -1;
$newEndRange = -1;

$answerArray = array();

//loop through array

if(in_array($noOfParticipant, $timeArray)){
	for ($i = 0; $i < 24; $i++) {
		if($timeArray[$i] = $noOfParticipant){
			array_push($answerArray, $timeArray[$i]);
		}
	}

	$str = processAnswerArray($answerArray);
	echo $str;

	//header('Location: eventMain.php?event_code='.$event_code.'&returnStr='.$str);
	
}


function processAnswerArray($answerArray) {
	$returnStr = "The ideal time to meet is ";

	if (sizeof($answerArray) == 1) {
		$returnStr .= "at " . $answerArray[0]. "00hrs";
	} elseif (sizeof($answerArray) == 0) {
		$returnStr = "There is no ideal time to meet :(";
	} else {
		//$returnStr .= "between ";
		//$previousAnswer = -1;
		//$counter = 0;
		$arraySize = sizeof($answerArray);
		$start = $answerArray[0];
		$end = $answerArray[$arraySize - 1];

		if ($start != 1 && $end != 24) {
			// do nothing
		} else {
			for($i = 0; $i < $arraySize; $i++) {
				if ($answerArray[$i+1] - $answerArray[$i] != 1) {
					$start = $answerArray[$i+1];
					$end = $answerArray[$i];
				}
			}
		}
		$returnStr .= "between " .$start. " and " .$end;

		return $returnStr;
	}
}

function processTime($time, $gmt){
	$convertedTime = $time - $gmt;

	if($convertedTime < 0){
		$convertedTime += 24;
	}

	return $convertedTime;
}




