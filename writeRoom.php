<?php

include "connectDatabaseRemote.php";

// $ymd = $_POST["yearMonthDay"];
// $hm = $_POST["hourMinute"];
$temp = $_POST["latestTemperature"];


/*
$ymd = "2024-01-31";
$hm = "12-34";
$temp = 34;
*/


$output = [];
$i = 0;
$query = "INSERT INTO myRoom (temperature) 
VALUES ('$temp')";

// echo "<br>" . $query . "<br>";

mysqli_query($dbServer,$query);

$query = "SELECT 
			MIN(temperature) AS min,
 			MAX(temperature) AS max, 
 			AVG(temperature) AS mean, 
 			count(id) AS n
FROM myRoom";
$result = mysqli_query($dbServer,$query)  ;
while ($data = mysqli_fetch_row($result))
{
	$output[$i] = $data;
	$i++;
}
$n = json_encode($output);
echo $n;
exit();


?>