<?php

include "connectTempleDB.php";

// $sensor = $_POST["sensorName"];
 $sensor = "home";
// read database and export for use in plotly

$query = "SELECT dataX ,dataY 
				 FROM arduinoSensor WHERE sensorName = '$sensor' ";
				// echo "<br>" . $query . "<br>" ;
//echo "JSON";
//include "make_json_from_query.php";

$query2 = $query;
$result2 = mysqli_query($dbServer,$query2);
$output =[];
$i = 0 ;

WHILE ($data = mysqli_fetch_assoc($result2))
{
	$output[$i]["x"] = $data["dataX"];
	$output[$i]["y"] = $data["dataY"];
	$i++;
}

$myJSON = json_encode($output);
// echo "<br>";
 echo $myJSON;
// echo "<br>";

?>