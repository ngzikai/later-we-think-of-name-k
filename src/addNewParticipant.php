<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

include 'connectDB.php';

$shortlink = $_POST["shortlink"];
$eventCode = $_POST["event_code"];
$localGMT = $_POST["gmt"];

$localGMT = intval($localGMT);

$sqlInsert = "INSERT INTO event_participants (event_code, shortlink)
        		VALUES ('".$eventCode."', '".$shortlink."')";

if ($conn->query($sqlInsert) === TRUE) {
} else {
    //echo "Error: " . $sqlInsert. "<br>" . $conn->error;
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
    //echo "0 results";
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

	// echo "StartTime: ";
	// echo $startTime;
	// echo "<br>";
	// echo "End Time:";
	// echo $endTime;
	// echo "<br>";
	// echo "GMT: ";
	// echo $gmt;
	// echo "<br>";

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

$answerArray = array();

//loop through array

if(in_array($noOfParticipant, $timeArray)){
	for ($i = 0; $i < 24; $i++) {
		if($timeArray[$i] == $noOfParticipant){
			array_push($answerArray, $i);
			//echo "Pushed " .$i. " into answerArray. <br>";
		}
	}

	$str = processAnswerArray($answerArray, $localGMT);
	//echo $str;

	header('Location: eventMain.php?event='.$eventCode.'&returnStr="'.$str.'"');
	
}


function processAnswerArray($answerArray, $localGMT) {

	$returnStr = "The ideal time to meet is ";

	if (sizeof($answerArray) == 1) {
		$start = formatTime($answerArray[0], $localGMT);
		$returnStr .= "at " . $start. "00hrs";
	} elseif (sizeof($answerArray) == 0) {
		$returnStr = "There is no ideal time to meet :(";
	} else {
		//$returnStr .= "between ";
		//$previousAnswer = -1;
		//$counter = 0;

		$arraySize = sizeof($answerArray);
		$start = $answerArray[0];
		$end = $answerArray[$arraySize - 1];

		 	for($i = 1; $i < $arraySize; $i++) {
		 		//echo "$i: ". $answerArray[$i]. "<br>";
		 		//echo "$i+1: " .$answerArray[$i-1]. "<br>";
				if ($answerArray[$i] - $answerArray[$i-1] != 1) {
					//echo "CONDITION TRIGGERED <br>";
					$start = $answerArray[$i];
					$end = $answerArray[$i-1];

				}
		}

		$start = formatTime($start, $localGMT);
		$end = formatTime($end, $localGMT);

		$returnStr .= "between " .$start. "00hrs and " .$end."00hrs.";
	}
	return $returnStr;
}

function processTime($time, $gmt){
	$convertedTime = $time - $gmt;

	if($convertedTime < 0){
		$convertedTime += 24;
	}

	return $convertedTime;
}

function formatTime($time, $localGMT){
	$time += $localGMT;

	if($time >= 24){
		$time -= 24;
	}elseif($time < 0){
		$time += 24;
	}

	$timeStr = strval($time);

	if(strlen($timeStr) == 1){
		$timeStr = "0".$timeStr;
	}

	return $timeStr;
}





