<?php

include "connectDatabaseRemote.php";

// read the myTemphumidity database and export for use in plotly

$query = "SELECT id,hourMinute,temperature, humidity  FROM myTempHumity ORDER BY id";
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_assoc($result);
$output =[];

$i = 0 ;
WHILE ($data = mysqli_fetch_assoc($result))
{
	$output[$i]["hourMinute"] = $data["hourMinute"];
	$output[$i]["temperature"] = $data["temperature"];
	$output[$i]["humidity"] = $data["humidity"];
	$i++;
}

// print_r($output);
$myJSON = json_encode($output);
echo $myJSON;

?>
