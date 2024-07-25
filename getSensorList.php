<?php

include "../connectTempleDB.php";

// read database and export for use in plotly

$query = "SELECT sensorName ,
				 COUNT(dataX)  AS N 
				 FROM arduinoSensor 
				 GROUP BY sensorName ";
$result = mysqli_query($dbServer,$query);
$output =[];
$i = 0 ;

WHILE ($data = mysqli_fetch_assoc($result))
{
	$output[$i]["count"] = $data["N"];
	$output[$i]["sensorName"] = $data["sensorName"];
	$i++;
}

$myJSON = json_encode($output);
// echo "<br>";
echo $myJSON;
// echo "<br>";

?>