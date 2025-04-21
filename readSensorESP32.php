<?php

include "connectDatabaseRemote.php";

 //$sensor = $_POST["sensorName"];
// $sensor = "Home";
// read database and export for use in plotly

$query = "SELECT id, value1,value2 
				 FROM sensorData ";
// echo "<br>" . $query . "<br>" ;
//echo "JSON";
//include "make_json_from_query.php";

$query2 = $query;
$result2 = mysqli_query($dbServer,$query2);
$output =[];
$i = 0 ;

WHILE ($data = mysqli_fetch_assoc($result2))
{
//	$output[$i]["x"] = ($data["id"]*15 - 15) / 60;  // time in minutes
	$output[$i]["x"] = $data["id"]; 
	$output[$i]["y"] = $data["value1"];
	$output[$i]["z"] = $data["value2"];
	$i++;
}

$myJSON = json_encode($output);
// echo "<br>";
 echo $myJSON;
// echo "<br>";

?>
