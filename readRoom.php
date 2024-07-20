<?php

include "connectDatabaseRemote.php";

// read database and export for use in plotly

$query = "SELECT hourMinute ,temperature  FROM myRoom ORDER BY id ";
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_row($result);
$output =[];
$dataX = [];
$dataY = [];
$time = [];
$i = 0 ;

WHILE ($data = mysqli_fetch_assoc($result))
{
	$output[$i]["hourMinute"] = $data["hourMinute"];
	$output[$i]["temperature"] = $data["temperature"];
	$i++;
}


// print_r($output);
$myJSON = json_encode($output);
// echo "<br>";
echo $myJSON;
// echo "<br>";
?>