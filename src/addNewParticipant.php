<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

include 'connectDB.php';

//$eventCode = $_POST["eventCode"];

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

	$result = $conn->($selectSql1);

	$startTime = $result["starttime"];
	$endTime = $result["endtime"];
	$gmt = $result["gmt"];

	$startTime = $startTime - $gmt;
	$endTime = $endTime - $gmt;

	if($startTime < $endTime){
		while($startTime != $endTime){
			$timeArray[$startTime] = $timeArray + 1;
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
}


function processAnswerArray() {
	$returnStr = "The ideal time to meet is ";

	if(sizeof($answerArray) == 1){
		$returnStr .= "at " . $answerArray[0]. "00hrs";
	}elseif(sizeof($answerArray) == 0){
		$returnStr = "There is no ideal time to meet :(";
	}else{
		$returnStr .= "between ";
		$arraySize = sizeof($answerArray);
		$previousAnswer = -1;

		for($i = 0; $i < $arraySize; $i++){
			if($previousAnswer == -1){
				$returnStr .= $answerArray[$i] "00hrs";
			}else{

			}
		}
	}
}




